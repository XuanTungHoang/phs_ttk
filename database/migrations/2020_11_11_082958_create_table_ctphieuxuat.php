<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCtphieuxuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctphieuxuat', function (Blueprint $table) {
            $table->integer('IDPhieuXuat')->unsigned();
            $table->foreign('IDPhieuXuat')->references('IDPhieuXuat')->on('phieuxuat')->onDelete('cascade');
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
        Schema::dropIfExists('ctphieuxuat');
    }
}
