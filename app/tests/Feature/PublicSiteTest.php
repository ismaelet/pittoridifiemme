<?php

use App\Models\Artist;
use App\Models\Image;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    // Never touch the development database: use a fresh in-memory sqlite for every test
    config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
    DB::purge();
    Artisan::call('migrate');

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
});

it('lists only artists that have images on the home page', function () {
    $with = Artist::create(['fname' => 'Enrico', 'lname' => 'Clauser', 'place' => 'Cavalese', 'date' => '1883-1928']);
    Image::create(['artID' => $with->ID]);
    Artist::create(['fname' => 'Senza', 'lname' => 'Immagini']);

    $this->get('/')
        ->assertOk()
        ->assertSee('Clauser Enrico')
        ->assertDontSee('Immagini Senza');
});

it('shows the artist gallery and wraps navigation around', function () {
    $artist = Artist::create(['fname' => 'Enrico', 'lname' => 'Clauser']);
    $first = Image::create(['artID' => $artist->ID, 'main' => true]);
    $second = Image::create(['artID' => $artist->ID]);

    $this->get('/artist?id='.$artist->ID.'&imgID='.$second->ID)
        ->assertOk()
        ->assertSee('(2 di 2)')
        ->assertSee($second->ID.'_l.jpg')
        ->assertSee('imgID='.$first->ID, false);
});

it('redirects unknown artists to the home page', function () {
    $this->get('/artist?id=999')->assertRedirect('/');
});
