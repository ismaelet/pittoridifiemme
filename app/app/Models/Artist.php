<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Artist extends Model
{
    protected $primaryKey = 'ID';

    protected static function booted(): void
    {
        // The legacy columns are NOT NULL, but forms submit empty fields as null.
        static::saving(function (Artist $artist) {
            foreach (['fname', 'lname', 'fname2', 'lname2', 'place', 'bio', 'date'] as $field) {
                $artist->$field ??= '';
            }
        });

        static::deleting(function (Artist $artist) {
            $artist->images->each->delete();
            Storage::disk('public')->delete('documents/'.$artist->ID.'.pdf');
        });
    }

    public $timestamps = false;

    protected $guarded = [];

    /** @return HasMany<Image, $this> */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'artID', 'ID')->orderByDesc('main')->orderBy('ID');
    }

    public function getFullNameAttribute(): string
    {
        $name = $this->lname.' '.$this->fname;

        if ($this->fname2 !== '' && $this->lname2 !== '') {
            $name .= ' - '.$this->lname2.' '.$this->fname2;
        }

        return $name;
    }

    // "Place date" line shown under the artist name
    public function getDetailsAttribute(): string
    {
        if ($this->date === '' && $this->place === '') {
            return '';
        }

        return $this->place.($this->date === '' ? '' : ' '.$this->date);
    }

    public function biographyUrl(): ?string
    {
        if (file_exists(Storage::disk('public')->path('documents/'.$this->ID.'.pdf'))) {
            return '/storage/documents/'.$this->ID.'.pdf';
        }

        return $this->bio !== '' ? $this->bio : null;
    }
}
