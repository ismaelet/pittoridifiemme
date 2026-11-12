<?php

namespace App\Filament\Resources\Artists\Pages;

use App\Filament\Resources\Artists\ArtistResource;
use App\Filament\Resources\Artists\Pages\Concerns\HandlesBiographyPdf;
use Filament\Resources\Pages\CreateRecord;

class CreateArtist extends CreateRecord
{
    use HandlesBiographyPdf;

    protected static string $resource = ArtistResource::class;

    protected function afterCreate(): void
    {
        $this->syncBiographyPdf();
    }
}
