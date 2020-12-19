<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pesanan', function (Blueprint $table) {
            $table->string('id',40);
            $table->string('customer',40);
            $table->string('paket',40);
            $table->integer('berat');
            $table->integer('grand_total');
            $table->string('status_pesanan',40);
            $table->string('status_pembayaran',40);
            $table->timestamps();

            $table->primary('id');

            $table->foreign('customer')
            ->references('id')->on('customer')
            ->onDelete('restrict');

            $table->foreign('paket')
            ->references('id')->on('paket')
            ->onDelete('restrict');
            
            $table->foreign('status_pesanan')
            ->references('id')->on('status_pesanan')
            ->onDelete('restrict');

            $table->foreign('status_pembayaran')
            ->references('id')->on('status_pembayaran')
            ->onDelete('restrict');
            
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_pesanan', function (Blueprint $table) {
            //
        });
    }
}
