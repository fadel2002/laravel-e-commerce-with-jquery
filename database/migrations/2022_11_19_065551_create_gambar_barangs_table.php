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
        Schema::create('gambar_barangs', function (Blueprint $table) {
            $table->id('id_gambar_barang');
            $table->foreignId('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade')->nullable();
            $table->string('gambar_barang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gambar_barangs');
    }
};