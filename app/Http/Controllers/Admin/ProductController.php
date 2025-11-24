<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image; // Pastikan baris ini ada

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk (dengan relasi kategori)
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::orderBy('category_name->id')->get(); 

        return view('admin.products.index', [
            'products' => $products,
            'categories' => $categories 
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('category_name->id')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|array',
            'product_name.id' => [
                'required', 'string', 'max:255',
                Rule::unique('products', 'product_name->id')
            ],
            'product_name.en' => [
                'required', 'string', 'max:255',
                Rule::unique('products', 'product_name->en')
            ],
            'description'   => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|numeric|min:0', // Koma sudah ada
            'image_url'     => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::beginTransaction();
        $path = null; 
        try {
            
            // Logika Upload WebP
            if ($request->hasFile('image_url')) {
                $file = $request->file('image_url');
                $path = 'products/' . uniqid() . '_' . time() . '.webp';
                $image_webp = Image::make($file)->encode('webp', 80);
                Storage::disk('public')->put($path, (string) $image_webp);
            }

            // Simpan data produk
            Product::create([
                'product_name'  => $validated['product_name'],
                'description'   => $validated['description'],
                'category_id'   => $validated['category_id'],
                'price'         => $validated['price'],
                'image_url'     => $path, // Path .webp
                'is_bestseller' => $request->boolean('is_bestseller'),
            ]);

            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produk baru berhasil ditambahkan.');

        } catch (\Throwable $th) {
            DB::rollBack();
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            
            // 🔽--- INI BAGIAN YANG DIPERBAIKI ---🔽
            return back()
                ->withInput()
                // Baris ->withErrors($validated) SUDAH DIHAPUS
                ->with('error', 'Terjadi kesalahan saat menyimpan produk: ' . $th->getMessage());
            // 🔼--- SELESAI PERBAIKAN ---🔼
        }
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name->id')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update data produk
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|array',
            'product_name.id' => [
                'required', 'string', 'max:255',
                Rule::unique('products', 'product_name->id')->ignore($product->id)
            ],
            'product_name.en' => [
                'required', 'string', 'max:255',
                Rule::unique('products', 'product_name->en')->ignore($product->id)
            ],
            'description'   => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|numeric|min:0', // Koma sudah ada
            'image_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::beginTransaction();
        $newPath = null; 
        try {
            $data = [
                'product_name'  => $validated['product_name'],
                'description'   => $validated['description'],
                'category_id'   => $validated['category_id'],
                'price'         => $validated['price'],
                'is_bestseller' => $request->boolean('is_bestseller'),
            ];

            // Logika Upload WebP (Update)
            if ($request->hasFile('image_url')) {
                if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                    Storage::disk('public')->delete($product->image_url);
                }
                $file = $request->file('image_url');
                $newPath = 'products/' . uniqid() . '_' . time() . '.webp';
                $image_webp = Image::make($file)->encode('webp', 80);
                Storage::disk('public')->put($newPath, (string) $image_webp);
                $data['image_url'] = $newPath;
            }

            $product->update($data); 
            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Data produk berhasil diperbarui.');

        } catch (\Throwable $th) {
            DB::rollBack();
            if ($newPath && Storage::disk('public')->exists($newPath)) {
                Storage::disk('public')->delete($newPath);
            }

            // 🔽--- INI BAGIAN YANG DIPERBAIKI ---🔽
            return back()
                ->withInput()
                // Baris ->withErrors($validated) SUDAH DIHAPUS
                ->with('error', 'Gagal memperbarui produk: ' . $th->getMessage());
            // 🔼--- SELESAI PERBAIKAN ---🔼
        }
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $product->delete();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produk berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Gagal menghapus produk: ' . $th->getMessage());
        }
    }
}