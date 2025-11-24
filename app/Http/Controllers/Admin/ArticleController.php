<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // REVISI: Tambahkan ini

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Menampilkan form untuk membuat artikel baru.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'subtitle' => 'required|array',
            'subtitle.id' => 'required|string|max:255',
            'subtitle.en' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('articles', 'public');

        // REVISI: Ambil data dari $validated, bukan $request
        Article::create([
            'title' => $validated['title'], // Spatie akan menangani array
            'subtitle' => $validated['subtitle'], // Spatie akan menangani array
            'description' => $validated['description'], // Spatie akan menangani array
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update(Request $request, Article $article)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'subtitle' => 'required|array',
            'subtitle.id' => 'required|string|max:255',
            'subtitle.en' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // REVISI: Tambahkan article_id untuk error handling di modal
            'article_id' => 'required|exists:articles,id', 
        ]);
        
        // REVISI: Ambil data dari $validated agar aman
        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Upload gambar baru
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy(Article $article)
    {
        // Hapus gambar dari storage
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}