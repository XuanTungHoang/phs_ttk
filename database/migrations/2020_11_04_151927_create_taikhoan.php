<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taikhoan', function (Blueprint $table) {
            //$table->id();
            $table->increments('IDTaiKhoan');
            $table->string('TenDangNhap')->unique();
            $table->string('MatKhau');
            $table->string('TenTaiKhoan');
            $table->string('GioiTinh');
            $table->string('SoDienThoai');
            $table->integer('IDLoaiTaiKhoan')->unsigned();
            $table->foreign('IDLoaiTaiKhoan')->references('IDLoaiTaiKhoan')->on('loaitaikhoan')->onDelete('cascade');
            $table->integer('TrangThai');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('taikhoan');
    }
}
