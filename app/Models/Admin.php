<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Penting: extends Authenticatable
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Admin extends Authenticatable implements FilamentUser
{
    protected $guarded = [];

    // Semua yang ada di tabel ini otomatis boleh masuk Filament
    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }
}