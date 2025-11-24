<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // <--- 1. TAMBAHKAN INI

class Location extends Model
{
    use HasFactory;
    use HasTranslations; // <--- 2. TAMBAHKAN INI

    // 3. TAMBAHKAN INI
    public $translatable = ['name', 'address'];

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'google_maps_url',
    ];
}