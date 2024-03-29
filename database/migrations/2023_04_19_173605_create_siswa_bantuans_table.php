<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaBantuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_bantuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bantuan_id');
            $table->uuid('siswa_id');
            $table->boolean('bantuan')->default(false);
            $table->float('bobot');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('siswa_bantuans', function (Blueprint $table) {
            $table->foreign('bantuan_id')->references('id')->on('bantuans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_bantuans');
    }
}