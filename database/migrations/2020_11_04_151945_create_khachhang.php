<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            //$table->id();
            $table->increments('IDKhachHang');
            $table->string('TenKhachHang');
            $table->string('DiaChi');
            $table->string('SoDienThoai');
            $table->integer('IDLoaiKhachHang')->unsigned();
            $table->foreign('IDLoaiKhachHang')->references('IDLoaiKhachHang')->on('loaikhachhang')->onDelete('cascade');
            $table->integer('TrangThai');
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
        Schema::dropIfExists('khachhang');
    }
}
