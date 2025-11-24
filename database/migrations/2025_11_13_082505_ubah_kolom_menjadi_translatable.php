<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbahKolomMenjadiTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ubah tabel products
        Schema::table('products', function (Blueprint $table) {
            $table->text('product_name')->change();
            $table->text('description')->change();
        });

        // Ubah tabel categories
        Schema::table('categories', function (Blueprint $table) {
            $table->text('category_name')->change();
        });

        // Ubah tabel articles
        Schema::table('articles', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('subtitle')->change();
            $table->text('description')->change();
        });

        // Ubah tabel abouts
        Schema::table('abouts', function (Blueprint $table) {
            $table->text('year_text')->change();
            $table->text('title')->change();
            $table->text('description')->change();
        });

        // Ubah tabel locations
        Schema::table('locations', function (Blueprint $table) {
            $table->text('name')->change();
            $table->text('address')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Opsional: Anda bisa menambahkan logika rollback di sini
        // Tapi untuk saat ini, biarkan kosong tidak masalah
    }
}