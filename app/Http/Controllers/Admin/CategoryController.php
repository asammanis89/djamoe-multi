<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // REVISI: Tambahkan ini untuk validasi unique

class CategoryController extends Controller
{
    // ==========================
    // INDEX: Tampilkan semua kategori
    // ==========================
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // ==========================
    // CREATE: Form tambah kategori
    // ==========================
    public function create()
    {
        return view('admin.categories.create');
    }

    // ==========================
    // STORE: Simpan kategori baru
    // ==========================
    public function store(Request $request)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $request->validate([
            'category_name' => 'required|array', // Pastikan ini adalah array
            'category_name.id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'category_name->id') // Cek unique untuk locale 'id'
            ],
            'category_name.en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'category_name->en') // Cek unique untuk locale 'en'
            ],
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'category_name' => $request->category_name, // Ini sudah benar, Spatie akan menangani array
        ];

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('categories', 'public');
        }

        Category::create($data); // Kode Anda sudah benar, tidak perlu diubah

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    // ==========================
    // EDIT: Form edit kategori
    // ==========================
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // ==========================
    // UPDATE: Perbarui kategori
    // ==========================
    public function update(Request $request, Category $category)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $request->validate([
            'category_name' => 'required|array',
            'category_name.id' => [
                'required',
                'string',
                'max:255',
                // Cek unique untuk locale 'id', abaikan data saat ini
                Rule::unique('categories', 'category_name->id')->ignore($category->id) 
            ],
            'category_name.en' => [
                'required',
                'string',
                'max:255',
                // Cek unique untuk locale 'en', abaikan data saat ini
                Rule::unique('categories', 'category_name->en')->ignore($category->id)
            ],
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'category_name' => $request->category_name, // Ini sudah benar, Spatie akan menangani array
        ];

        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada
            if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                Storage::disk('public')->delete($category->image_url);
            }

            // Simpan gambar baru
            $data['image_url'] = $request->file('image_url')->store('categories', 'public');
        }

        $category->update($data); // Kode Anda sudah benar, tidak perlu diubah

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    // ==========================
    // DESTROY: Hapus kategori
    // ==========================
    public function destroy(Category $category)
    {
        if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
            Storage::disk('public')->delete($category->image_url);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}