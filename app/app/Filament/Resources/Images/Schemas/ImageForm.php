<?php

namespace App\Filament\Resources\Images\Schemas;

use App\Models\Artist;
use App\Models\Image;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class ImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('artID')
                    ->label('Artista che lo ha realizzato')
                    ->relationship('artist', 'lname', fn ($query) => $query->orderBy('lname')->orderBy('fname'))
                    ->getOptionLabelFromRecordUsing(fn (Artist $record) => $record->full_name)
                    ->searchable(['fname', 'lname', 'fname2', 'lname2'])
                    ->preload()
                    ->required(),
                FileUpload::make('files')
                    ->label('Immagini')
                    ->multiple()
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('local')
                    ->directory('tmp-uploads')
                    ->visibility('private')
                    ->reorderable()
                    ->required()
                    ->visibleOn('create'),
                ImageEntry::make('preview')
                    ->label('Anteprima')
                    ->disk('public')
                    ->state(fn (Image $record) => 'pics/'.$record->ID.'_m.jpg')
                    ->imageHeight('20rem')
                    ->visibleOn('edit'),
                Toggle::make('main')
                    ->label('È l\'immagine di copertina')
                    ->visibleOn('edit'),
            ]);
    }
}
