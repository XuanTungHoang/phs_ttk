<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sach', function (Blueprint $table) {
            $table->increments('IDSach');
            $table->string('TenSach');
            $table->string('TacGia');
            $table->string('NhaXuatBan');
            $table->string('NamXuatBan');
            $table->string('TomTat');
            $table->float('GiaNhap');
            $table->float('GiaBan');
            $table->integer('DaBan');
            $table->integer('ConLai');
            $table->float('TienDaThuVe');
            $table->float('TienConNo');
            $table->string('TrangThai');
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
        Schema::dropIfExists('sach');
    }
}
