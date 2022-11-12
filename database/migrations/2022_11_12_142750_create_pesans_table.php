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
        Schema::create('pesans', function (Blueprint $table) {
            $table->id('id_pesan');
            $table->foreignId('id_pengirim_pesan')->references('id_user')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('id_penerima_pesan')->references('id_user')->on('users')->onDelete('cascade')->nullable();
            $table->string('isi_pesan')->nullable();
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
        Schema::dropIfExists('pesans');
    }
};