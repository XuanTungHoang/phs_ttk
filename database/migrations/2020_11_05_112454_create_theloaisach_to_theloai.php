<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheloaisachToTheloai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sach', function (Blueprint $table) {
            $table->integer('IDTheLoai')->unsigned()->after('NamXuatBan');
            $table->foreign('IDTheLoai')->references('IDTheLoai')->on('theloai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sach', function($table) {
            $table->dropColumn('IDTheLoai');
        });
    }
}
