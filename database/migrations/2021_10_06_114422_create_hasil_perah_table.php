<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPerahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_perah', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_sapi')->unsigned();
            $table->foreign('id_sapi')
                ->references('id')
                ->on('sapi')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('jumlah_perah');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('tanggal_perah');
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
        Schema::dropIfExists('hasil_perah');
    }
}
