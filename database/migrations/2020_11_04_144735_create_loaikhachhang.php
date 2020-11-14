<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaikhachhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaikhachhang', function (Blueprint $table) {
            $table->increments('IDLoaiKhachHang');
          //  $table->foreign('IDLoaiKhachHang')->references('IDLoaiKhachHang')->on('khachhang')->unsigned();
            $table->string('TenLoaiKhachHang');
            $table->string('MoTa');
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
        Schema::dropIfExists('loaikhachhang');
    }
}
