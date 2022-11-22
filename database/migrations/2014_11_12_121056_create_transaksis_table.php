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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('metode_transaksi')->nullable();
            $table->bigInteger('total_transaksi')->nullable();
            // 0 masih dalam cart
            // 1 sudah checkout atau bayar dan belum diterima user
            // 2 sudah checkout atau bayar dan sudah diterima user
            $table->smallInteger('status_transaksi')->default(0); 
            $table->string('alamat_dikirim')->nullable();
            $table->foreignId('id_user')->references('id_user')->on('users')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
};