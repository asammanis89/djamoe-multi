<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        $totalArtikel = Article::count();

        // ✅ Pastikan kolom role benar, dan nilai sesuai database
        $totalUsers = User::where(function ($query) {
            $query->where('role', 'admin')
                  ->orWhere('role', 'superadmin');
        })->count();

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalKategori',
            'totalArtikel',
            'totalUsers'
        ));
    }
}