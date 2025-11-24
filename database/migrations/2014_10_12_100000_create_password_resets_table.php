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
        Schema::create('password_resets', function (Blueprint $table) {
            // PERBAIKAN: Ganti ->primary() menjadi ->index()
            // Ini memungkinkan satu email memiliki beberapa token reset (meskipun 
            // hanya yang terbaru yang valid), dan mempercepat pencarian.
            $table->string('email')->index(); 
            
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};