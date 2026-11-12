<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Artists\ArtistResource;
use App\Filament\Resources\Images\ImageResource;
use App\Models\Artist;
use App\Models\Image;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CatalogStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Artisti', Artist::count())
                ->description('Lista degli artisti')
                ->url(ArtistResource::getUrl('index')),
            Stat::make('Dipinti', Image::count())
                ->description('Lista dei dipinti')
                ->url(ImageResource::getUrl('index')),
        ];
    }
}
