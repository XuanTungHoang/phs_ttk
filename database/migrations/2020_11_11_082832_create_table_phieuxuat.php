<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePhieuxuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieuxuat', function (Blueprint $table) {
            $table->increments('IDPhieuXuat');
            $table->integer('IDTaiKhoan')->unsigned();
            $table->foreign('IDTaiKhoan')->references('IDTaiKhoan')->on('taikhoan')->onDelete('cascade');
            $table->integer('IDKhachHang')->unsigned();
            $table->foreign('IDKhachHang')->references('IDKhachHang')->on('khachhang')->onDelete('cascade');
            $table->date('NgayXuat');
            $table->time('GioXuat');
            $table->string('GhiChu');
            $table->float('TongTien');
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
        Schema::dropIfExists('phieuxuat');
    }
}
