<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// REVISI: Kita tidak perlu 'Rule' di sini karena sepertinya 'title' tidak harus unik

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::latest()->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'year_text' => 'required|array',
            'year_text.id' => 'required|string|max:255',
            'year_text.en' => 'required|string|max:255',
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('abouts', 'public');

        // REVISI: Gunakan $validated untuk keamanan
        $data = $validated;
        $data['image'] = $path;

        About::create($data); // Spatie akan menangani array

        return redirect()->route('admin.abouts.index')->with('success', 'Cerita berhasil ditambahkan.');
    }

    public function edit(About $about)
    {
        return view('admin.abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'year_text' => 'required|array',
            'year_text.id' => 'required|string|max:255',
            'year_text.en' => 'required|string|max:255',
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'description.en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // REVISI: Tambahkan about_id untuk error handling di modal
            'about_id' => 'required|exists:abouts,id',
        ]);

        // REVISI: Gunakan $validated untuk keamanan
        $data = $validated;
        
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($about->image);
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        $about->update($data); // Spatie akan menangani array

        return redirect()->route('admin.abouts.index')->with('success', 'Cerita berhasil diperbarui.');
    }

    public function destroy(About $about)
    {
        Storage::disk('public')->delete($about->image);
        $about->delete();
        return redirect()->route('admin.abouts.index')->with('success', 'Cerita berhasil dihapus.');
    }
}