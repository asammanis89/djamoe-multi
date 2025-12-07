<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Flyer;
use App\Models\About;
use App\Models\Location;
use App\Models\Article;

class PageController extends Controller
{
    /**
     * Menampilkan halaman Beranda.
     */
    public function index()
    {
        $flyers = Flyer::latest()->get();
        $featuredProducts = Product::with('category')
            ->where('is_bestseller', true)
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('flyers', 'featuredProducts'));
    }

    /**
     * Menampilkan halaman Produk.
     */
    public function produk(Category $category = null)
    {
        $whatsappNumber = '6282232279783';
        $categories = null;
        $products = null;

        if ($category) {
            $category->load('products');
            $products = $category->products;
        } else {
            $categories = Category::latest()->get();
        }

        return view('produk', compact('category', 'categories', 'products', 'whatsappNumber'));
    }

    /**
     * Menampilkan halaman Aktivitas.
     */
    public function aktivitas()
    {
        $articles = Article::latest()->get();
        return view('aktivitas', compact('articles'));
    }

    /**
     * Menampilkan halaman Outlet / Temukan Kami.
     */
    public function outlet()
    {
        // UBAH 1: Urutkan berdasarkan Nama (bukan created_at), supaya rapi A-Z
        // UBAH 2: Tambahkan ->groupBy('name') di ujung
        $groupedLocations = Location::orderBy('name', 'asc')->get()->groupBy('name');
        
        // UBAH 3: Kirim variabel dengan nama 'groupedLocations' (sesuai Blade yang baru)
        return view('outlet', compact('groupedLocations'));
    }

    /**
     * Menampilkan halaman Tentang Kami (Cerita Kami).
     */
    public function about()
    {
        $abouts = About::orderBy('year_text', 'asc')->get(); 
        return view('about', compact('abouts'));
    }

    /**
     * Mengambil data produk berdasarkan kategori untuk permintaan AJAX.
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        // ===============================================
        // REVISI 1: Ubah $products menjadi array kustom
        // Ini akan mengirim JSON mentah yang dibutuhkan JS Anda
        // ===============================================
        $productData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'is_bestseller' => $product->is_bestseller,
                
                // Ini akan mengirim: "product_name": {"id": "indo", "en": "eng"}
                'product_name' => $product->getTranslations('product_name'), 
                'description' => $product->getTranslations('description'),
                'full_description' => $product->getTranslations('full_description'),
            ];
        });

        return response()->json([
            // Kirim JSON kategori juga
            'category' => $category->getTranslations('category_name'), 
            'products' => $productData
        ]);
    }

    /**
     * Mengambil detail satu produk untuk ditampilkan di modal (AJAX).
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductDetail(Product $product)
    {
        // ===============================================
        // REVISI 2: Kirim sebagai OBJEK JSON manual
        // ===============================================
        return response()->json([
            'id' => $product->id,
            'price' => $product->price,
            'image_url' => $product->image_url,
            
            // Ini akan mengirim: "product_name": {"id": "indo", "en": "eng"}
            'product_name' => $product->getTranslations('product_name'),
            'description' => $product->getTranslations('description'),
            'full_description' => $product->getTranslations('full_description'),
        ]);
    }
}