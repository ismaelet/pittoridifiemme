<?php

namespace App\Filament\Resources\Artists\Schemas;

use App\Models\Artist;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ArtistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Nome e cognome')
                    ->columns(2)
                    ->schema([
                        TextInput::make('fname')->label('Nome')->required()->maxLength(30),
                        TextInput::make('lname')->label('Cognome')->required()->maxLength(30),
                    ]),
                Section::make('Cognome e nome alternativi (opzionale)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('lname2')->label('Cognome alternativo')->maxLength(30),
                        TextInput::make('fname2')->label('Nome alternativo')->maxLength(30),
                    ]),
                Section::make('Dettagli')
                    ->columns(2)
                    ->schema([
                        TextInput::make('place')->label('Luogo di nascita')->maxLength(30),
                        TextInput::make('date')->label('Data di nascita e morte')->maxLength(30),
                    ]),
                Section::make('Biografia')
                    ->description('Indica un link esterno oppure carica un PDF: il PDF ha la precedenza e sostituisce il link.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('bio')
                            ->label('URL biografia')
                            ->url()
                            ->maxLength(500),
                        FileUpload::make('bio_pdf')
                            ->label('Biografia in PDF')
                            ->disk('public')
                            ->directory('documents')
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (FileUpload $component, ?Artist $record) {
                                $path = $record ? 'documents/'.$record->ID.'.pdf' : null;

                                if ($path && Storage::disk('public')->exists($path)) {
                                    $component->state([$path]);
                                }
                            }),
                    ]),
            ]);
    }
}
