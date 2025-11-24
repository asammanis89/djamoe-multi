<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; 

class Product extends Model
{
    use HasFactory;
    use HasTranslations; 

    // 3. TAMBAHKAN INI
    public $translatable = [
        'product_name', 
        'description', 
        'full_description' // <--- REVISI DI SINI (TAMBAHKAN INI)
    ];

    protected $fillable = [
        'category_id', 
        'product_name', 
        'description',
        'full_description', // Pastikan ini juga ada di $fillable jika Anda menggunakannya
        'price', 
        'image_url', 
        'is_bestseller'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}