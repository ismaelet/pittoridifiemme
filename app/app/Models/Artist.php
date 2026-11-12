<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    protected $primaryKey = 'ID';

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
        if (file_exists(public_path('uploads/documents/'.$this->ID.'.pdf'))) {
            return '/uploads/documents/'.$this->ID.'.pdf';
        }

        return $this->bio !== '' ? $this->bio : null;
    }
}
