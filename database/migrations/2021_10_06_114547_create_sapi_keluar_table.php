<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapiKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapi_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_keluar');
            $table->bigInteger('id_sapi')->unsigned();
            $table->foreign('id_sapi')
                ->references('id')
                ->on('sapi')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('harga');
            $table->string('status');
            $table->string('keterangan');
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
        Schema::dropIfExists('sapi_keluar');
    }
}
