<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // <--- 1. TAMBAHKAN INI

class Article extends Model
{
    use HasFactory;
    use HasTranslations; // <--- 2. TAMBAHKAN INI

    // 3. TAMBAHKAN INI
    public $translatable = ['title', 'subtitle', 'description'];

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
    ];
}