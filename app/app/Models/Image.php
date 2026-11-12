<?php

namespace App\Models;

use App\Services\ImageProcessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = ['main' => 'boolean'];

    protected static function booted(): void
    {
        static::deleted(function (Image $image) {
            app(ImageProcessor::class)->delete($image->ID);
            $image->ensureArtistHasMain();
        });
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artID', 'ID');
    }

    public function setAsMain(): void
    {
        static::where('artID', $this->artID)->where('ID', '<>', $this->ID)->update(['main' => false]);
        $this->update(['main' => true]);
    }

    // Every artist with paintings must have exactly one cover image.
    public function ensureArtistHasMain(?int $artistId = null): void
    {
        $artistId ??= $this->artID;

        if (static::where('artID', $artistId)->where('main', true)->exists()) {
            return;
        }

        static::where('artID', $artistId)->orderBy('ID')->first()?->update(['main' => true]);
    }

    public function mediumUrl(): string
    {
        return '/storage/pics/'.$this->ID.'_m.jpg';
    }

    public function largeUrl(): string
    {
        return '/storage/pics/'.$this->ID.'_l.jpg';
    }
}
