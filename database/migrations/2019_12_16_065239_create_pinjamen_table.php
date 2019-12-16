<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->increments('idPinjaman');
            $table->integer('idNasabah')->unsigned();
            $table->foreign('idNasabah')->references('idNasabah')->on('nasabahs')->onDelete('cascade');
            $table->float('bunga', 8, 2);
            $table->decimal('jmlPinjam',9,3);
            $table->decimal('sisaPinjam',9,3);
            $table->string('status', 9);
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
        Schema::dropIfExists('pinjamans');
    }
}
