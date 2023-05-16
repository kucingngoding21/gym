<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_struk');
            $table->integer('id_kasir')->nullable();
            $table->integer('id_member');
            $table->integer('id_transaksi')->nullable();
            $table->string('jangka_waktu');
            $table->string('jenis_kelas');
            $table->string('biaya_kelas');
            $table->integer('nominal_deposit');
            $table->integer('bonus_deposit')->nullable();
            $table->integer('total_deposit');
            $table->datetime('tanggal');
            $table->datetime('expired');
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
        Schema::dropIfExists('deposit_kelas');
    }
}
