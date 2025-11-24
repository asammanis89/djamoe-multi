<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Menampilkan semua user (admin & super_admin), kecuali diri sendiri.
     */
    public function index()
    {
        $currentUserId = Auth::id(); 
        
        // ✅ Gunakan 'id', bukan 'id_user'
        $users = User::where('id', '!=', $currentUserId)->get();
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Membuat user baru (admin atau super_admin).
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255', // TAMBAHKAN VALIDASI INI
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required',
    ]);

    User::create([
        'name' => $request->name, // TAMBAHKAN BARIS INI
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'is_active' => true,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
}

    /**
     * Menampilkan form edit user (kecuali diri sendiri).
     */
    public function edit(User $user)
    {
        // ✅ Gunakan 'id'
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa mengedit data diri sendiri di halaman ini.');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user (termasuk role, kecuali diri sendiri).
     */
    public function update(Request $request, User $user)
    {
        // ✅ Gunakan 'id'
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa memperbarui data diri sendiri.');
        }

        $request->validate([
            // ✅ Perbaiki unique validation: ganti 'id_user' → 'id'
            'username' => 'required|string|max:255|unique:users,username,' . $user->id . ',id',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|in:admin,super_admin',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Menonaktifkan user (kecuali diri sendiri).
     */
    public function deactivate(User $user)
    {
        // ✅ Gunakan 'id'
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menonaktifkan diri sendiri.');
        }

        $user->update(['is_active' => false]);
        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dinonaktifkan.');
    }

    /**
     * Mengaktifkan user.
     */
    public function activate(User $user)
    {
        $user->update(['is_active' => true]);
        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diaktifkan.');
    }

    /**
     * Menghapus user (kecuali diri sendiri).
     */
    public function destroy(User $user)
    {
        // ✅ Gunakan 'id'
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus diri sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}