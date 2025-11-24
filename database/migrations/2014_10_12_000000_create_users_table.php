<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Standar Primary Key
            $table->id(); 
            
            // --- Kolom Gabungan ---
            
            // Dari file pertama (sesuai model awal Anda)
            $table->string('name'); 
            
            // Dari file kedua
            $table->string('username')->unique(); 
            
            // Dari kedua file (wajib ada)
            $table->string('email')->unique();
            $table->string('password');

            // Dari file kedua (default 'admin')
            $table->string('role')->default('admin'); 

            // Dari file kedua
            $table->boolean('is_active')->default(true); 

            // Dari file pertama (standar Laravel, sangat disarankan)
            $table->timestamp('email_verified_at')->nullable(); 

            // Dari kedua file (standar Laravel)
            $table->rememberToken();
            $table->timestamps(); // (membuat created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};