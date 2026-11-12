<?php

namespace App\Filament\Resources\Images\Tables;

use App\Models\Artist;
use App\Models\Image;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('artist'))
            ->columns([
                TextColumn::make('ID')->label('ID')->sortable(),
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->disk('public')
                    ->state(fn (Image $record) => 'pics/'.$record->ID.'_m.jpg')
                    ->imageHeight('5rem')
                    ->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('artist.lname')
                    ->label('Artista')
                    ->state(fn (Image $record) => $record->artist?->full_name)
                    ->sortable()
                    ->searchable(['fname', 'lname', 'fname2', 'lname2'])
                    ->url(fn (Image $record) => $record->largeUrl(), shouldOpenInNewTab: true),
                IconColumn::make('main')->label('È la copertina?')->boolean()->sortable(),
            ])
            ->defaultSort('ID', 'desc')
            ->filters([
                SelectFilter::make('artID')
                    ->label('Artista')
                    ->options(fn () => Artist::orderBy('lname')->orderBy('fname')->get()->pluck('full_name', 'ID')->all())
                    ->searchable(),
                SelectFilter::make('main')
                    ->label('Copertina')
                    ->options([1 => 'Solo copertine', 0 => 'Non copertine']),
            ])
            ->recordActions([
                Action::make('setMain')
                    ->label('Imposta come copertina')
                    ->icon('heroicon-o-star')
                    ->hidden(fn (Image $record) => $record->main)
                    ->action(fn (Image $record) => $record->setAsMain()),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
