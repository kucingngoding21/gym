<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_struk');
            $table->integer('id_kasir');
            $table->integer('id_member');
             $table->integer('id_transaksi')->nullable();
            $table->integer('nominal_deposit');
            $table->integer('bonus_deposit')->nullable();
            $table->integer('total_deposit');
            $table->integer('jangka_waktu')->nullable();
            $table->datetime('tgl_transaksi')->nullable();
            $table->string('jenis_kelas')->nullable();
             $table->string('nama_deposit');
            $table->datetime('expired')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
