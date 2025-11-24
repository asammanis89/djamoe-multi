<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek dulu: jangan sampai buat duplikat
        if (DB::table('users')->where('email', 'superadmin@kreasilokal.com')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'superadmin@kreasilokal.com',
                'email_verified_at' => now(),
                'password' => Hash::make('super123'), // 🔑 password: super123
                'role' => 'superadmin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "\n✅ Superadmin berhasil dibuat!\n";
            echo "📧 Email: superadmin@kreasilokal.com\n";
            echo "🔑 Password: super123\n\n";
        } else {
            echo "\n⚠️ Akun superadmin sudah ada.\n";
        }
    }
}