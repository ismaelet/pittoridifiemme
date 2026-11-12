<?php

namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use App\Models\Image;
use App\Services\ImageProcessor;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;

    // One record per uploaded file; the first image of an artist becomes its cover.
    protected function handleRecordCreation(array $data): Model
    {
        $files = $data['files'];
        $processor = app(ImageProcessor::class);
        $disk = Storage::disk('local');

        foreach ($files as $file) {
            $image = Image::create(['artID' => $data['artID'], 'main' => false]);
            $image->ensureArtistHasMain();

            $processor->store($disk->path($file), $image->ID);
            $disk->delete($file);
        }

        return $image;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
