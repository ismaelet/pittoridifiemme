<?php

namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $previousArtist = $record->artID;
        $record->update($data);

        if ($record->main) {
            $record->setAsMain();
        } else {
            $record->ensureArtistHasMain();
        }

        if ($previousArtist !== (int) $record->artID) {
            $record->ensureArtistHasMain($previousArtist);
        }

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
