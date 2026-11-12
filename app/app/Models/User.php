<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Maps the legacy `users` table: `admin` > 0 grants access to the admin panel.
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable;

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->admin > 0;
    }

    public function getFilamentName(): string
    {
        $name = trim($this->firstname.' '.$this->lastname);

        return $name !== '' ? $name : $this->username;
    }
}
