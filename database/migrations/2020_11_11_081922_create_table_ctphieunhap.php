<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCtphieunhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctphieunhap', function (Blueprint $table) {
            $table->integer('IDPhieuNhap')->unsigned();
            $table->foreign('IDPhieuNhap')->references('IDPhieuNhap')->on('phieunhap')->onDelete('cascade');
            $table->integer('IDSach')->unsigned();
            $table->foreign('IDSach')->references('IDSach')->on('sach')->onDelete('cascade');
            $table->integer('SoLuong');
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
        Schema::dropIfExists('ctphieunhap');
    }
}
