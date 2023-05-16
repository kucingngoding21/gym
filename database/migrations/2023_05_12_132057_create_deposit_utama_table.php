<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositUtamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_utama', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_struk');
            $table->integer('id_kasir');
            $table->integer('id_transaksi')->nullable();
            $table->integer('id_member');
            $table->integer('nominal_deposit');
            $table->datetime('masa_aktif');
            $table->integer('jangka_waktu')->nullable();
            $table->integer('bonus_deposit')->nullable();
            $table->integer('total_deposit');
            $table->datetime('tgl');
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
        Schema::dropIfExists('deposit_utama');
    }
}
