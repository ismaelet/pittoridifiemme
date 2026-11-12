<?php

namespace App\Filament\Resources\Artists\Pages;

use App\Filament\Resources\Artists\ArtistResource;
use App\Filament\Resources\Artists\Pages\Concerns\HandlesBiographyPdf;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArtist extends EditRecord
{
    use HandlesBiographyPdf;

    protected static string $resource = ArtistResource::class;

    protected function afterSave(): void
    {
        $this->syncBiographyPdf();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
