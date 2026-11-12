<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $guarded = [];

    public function mediumUrl(): string
    {
        return '/uploads/pics/'.$this->ID.'_m.jpg';
    }

    public function largeUrl(): string
    {
        return '/uploads/pics/'.$this->ID.'_l.jpg';
    }
}
