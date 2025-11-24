<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
// REVISI: Kita tidak perlu 'Rule' di sini karena nama/alamat lokasi tidak perlu unik

class LocationController extends Controller
{
    /**
     * Menampilkan daftar semua lokasi.
     */
    public function index()
    {
        // REVISI: Urutkan berdasarkan terjemahan 'id'
        $locations = Location::orderBy('name->id')->get(); 
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Menampilkan form untuk membuat lokasi baru.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Menyimpan lokasi baru ke dalam database.
     */
    public function store(Request $request)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'name' => 'required|array',
            'name.id' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'address' => 'required|array',
            'address.id' => 'required|string',
            'address.en' => 'required|string',
            'phone_number' => 'nullable|string|max:20',
            'google_maps_url' => 'nullable|url',
        ]);

        // REVISI: Gunakan $validated untuk create
        Location::create($validated); // Spatie akan menangani array

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit lokasi.
     */
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Mengupdate lokasi yang ada di database.
     */
    public function update(Request $request, Location $location)
    {
        // REVISI: Sesuaikan aturan validasi untuk data translatable
        $validated = $request->validate([
            'name' => 'required|array',
            'name.id' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'address' => 'required|array',
            'address.id' => 'required|string',
            'address.en' => 'required|string',
            'phone_number' => 'nullable|string|max:20',
            'google_maps_url' => 'nullable|url',
            // REVISI: Tambahkan location_id untuk error handling di modal
            'location_id' => 'required|exists:locations,id',
        ]);

        // REVISI: Gunakan $validated untuk update
        $location->update($validated); // Spatie akan menangani array

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Menghapus lokasi dari database.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}