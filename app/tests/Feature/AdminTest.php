<?php

use App\Filament\Resources\Artists\Pages\CreateArtist;
use App\Filament\Resources\Artists\Pages\EditArtist;
use App\Filament\Resources\Artists\Pages\ListArtists;
use App\Filament\Resources\Images\Pages\CreateImage;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Filament\Resources\Images\Pages\ListImages;
use App\Models\Artist;
use App\Models\Image;
use App\Models\User;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    // Never touch the development database: use a fresh in-memory sqlite for every test
    config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
    DB::purge();
    Artisan::call('migrate');

    Storage::fake('public');
    Storage::fake('local');

    $this->app->instance(Vite::class, new class
    {
        public function __invoke(): string
        {
            return '';
        }

        public function asset(string $asset): string
        {
            return '/'.$asset;
        }
    });

    $this->admin = User::create(['username' => 'admin', 'password' => 'secret', 'email' => 'admin@example.com', 'firstname' => '', 'lastname' => '', 'admin' => 1, 'security' => '']);
    Filament::setCurrentPanel('admin');
});

it('logs in with the email and gates the panel on the admin flag', function () {
    Livewire::test(Login::class)
        ->fillForm(['email' => 'admin@example.com', 'password' => 'secret'])
        ->call('authenticate')
        ->assertHasNoFormErrors();

    expect(auth()->id())->toBe($this->admin->ID);

    auth()->logout();
    $user = User::create(['username' => 'nobody', 'password' => 'secret', 'email' => 'nobody@example.com', 'firstname' => '', 'lastname' => '', 'admin' => 0, 'security' => '']);
    $this->actingAs($user)->get('/admin')->assertForbidden();
});

it('creates and edits an artist, handling the biography pdf', function () {
    $this->actingAs($this->admin);

    Livewire::test(CreateArtist::class)
        ->fillForm(['fname' => 'Enrico', 'lname' => 'Clauser', 'place' => 'Cavalese', 'date' => '1883-1928', 'bio' => 'https://example.com/bio'])
        ->call('create')
        ->assertHasNoFormErrors();

    $artist = Artist::firstOrFail();
    expect($artist->bio)->toBe('https://example.com/bio');

    Livewire::test(EditArtist::class, ['record' => $artist->ID])
        ->fillForm(['bio_pdf' => UploadedFile::fake()->create('bio.pdf', 10, 'application/pdf')])
        ->call('save')
        ->assertHasNoFormErrors();

    Storage::disk('public')->assertExists('documents/'.$artist->ID.'.pdf');
    expect($artist->fresh()->bio)->toBe('');
    expect($artist->fresh()->biographyUrl())->toBe('/storage/documents/'.$artist->ID.'.pdf');

    Livewire::test(EditArtist::class, ['record' => $artist->ID])
        ->fillForm(['bio' => 'https://example.com/new'])
        ->call('save');

    Storage::disk('public')->assertMissing('documents/'.$artist->ID.'.pdf');
    expect($artist->fresh()->bio)->toBe('https://example.com/new');
});

it('uploads paintings, keeps a single cover and cleans up on delete', function () {
    $this->actingAs($this->admin);
    $artist = Artist::create(['fname' => 'Enrico', 'lname' => 'Clauser']);

    Livewire::test(CreateImage::class)
        ->fillForm([
            'artID' => $artist->ID,
            'files' => [UploadedFile::fake()->image('a.jpg', 800, 1000), UploadedFile::fake()->image('b.png', 900, 700)],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $images = Image::orderBy('ID')->get();
    expect($images)->toHaveCount(2)
        ->and($images->where('main', true))->toHaveCount(1)
        ->and($images[0]->main)->toBeTrue();

    foreach ($images as $image) {
        Storage::disk('public')->assertExists('pics/'.$image->ID.'_l.jpg');
        Storage::disk('public')->assertExists('pics/'.$image->ID.'_m.jpg');
    }

    Livewire::test(EditImage::class, ['record' => $images[0]->ID])
        ->assertSeeHtml('/storage/pics/'.$images[0]->ID.'_m.jpg');

    Livewire::test(ListImages::class)
        ->assertSeeHtml('/storage/pics/'.$images[0]->ID.'_m.jpg')
        ->callTableAction('setMain', $images[1]);
    expect($images[1]->fresh()->main)->toBeTrue()->and($images[0]->fresh()->main)->toBeFalse();

    Livewire::test(EditImage::class, ['record' => $images[1]->ID])
        ->fillForm(['main' => false])
        ->call('save');
    expect(Image::where('main', true)->count())->toBe(1);

    $images[1]->delete();
    Storage::disk('public')->assertMissing('pics/'.$images[1]->ID.'_m.jpg');
    expect($images[0]->fresh()->main)->toBeTrue();

    Livewire::test(ListArtists::class)->callTableAction('delete', $artist);
    expect(Image::count())->toBe(0);
    Storage::disk('public')->assertMissing('pics/'.$images[0]->ID.'_l.jpg');
});
