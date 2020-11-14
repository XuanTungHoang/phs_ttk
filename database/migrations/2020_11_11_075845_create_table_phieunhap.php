<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePhieunhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->increments('IDPhieuNhap');
            $table->integer('IDTaiKhoan')->unsigned();
            $table->foreign('IDTaiKhoan')->references('IDTaiKhoan')->on('taikhoan')->onDelete('cascade');
            $table->integer('IDKhachHang')->unsigned();
            $table->foreign('IDKhachHang')->references('IDKhachHang')->on('khachhang')->onDelete('cascade');
            $table->date('NgayNhap');
            $table->time('GioNhap');
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
        Schema::dropIfExists('phieunhap');
    }
}
