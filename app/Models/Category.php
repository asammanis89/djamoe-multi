<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; // <--- 1. TAMBAHKAN INI

class Category extends Model
{
    use HasFactory;
    use HasTranslations; // <--- 2. TAMBAHKAN INI

    // 3. TAMBAHKAN INI
    public $translatable = ['category_name'];

    protected $fillable = ['category_name', 'image_url'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}