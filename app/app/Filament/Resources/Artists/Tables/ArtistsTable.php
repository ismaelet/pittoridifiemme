<?php

namespace App\Filament\Resources\Artists\Tables;

use App\Models\Artist;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ArtistsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID')->label('ID')->sortable(),
                TextColumn::make('full_name')
                    ->label('Nome completo')
                    ->sortable(['lname', 'fname'])
                    ->searchable(['fname', 'lname', 'fname2', 'lname2']),
                TextColumn::make('alternative_name')
                    ->label('Nome alternativo')
                    ->state(fn (Artist $record) => trim($record->lname2.' '.$record->fname2)),
                TextColumn::make('place')->label('Luogo di nascita')->searchable(),
                TextColumn::make('date')->label('Data di nascita e morte'),
                IconColumn::make('has_biography')
                    ->label('Biografia')
                    ->boolean()
                    ->state(fn (Artist $record) => $record->biographyUrl() !== null),
                TextColumn::make('images_count')->label('Dipinti')->counts('images')->sortable(),
            ])
            ->defaultSort(fn (Builder $query) => $query->orderBy('lname')->orderBy('fname'))
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalDescription('Verranno eliminati anche tutti i dipinti e la biografia in PDF dell\'artista.'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
