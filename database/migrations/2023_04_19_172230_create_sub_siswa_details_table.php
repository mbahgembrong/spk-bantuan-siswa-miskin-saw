<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSiswaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_siswa_details', function (Blueprint $table) {
                $table->uuid('id');
                $table->uuid('siswa_detail_id');
                $table->uuid('kriteria_id')->nullable();
                $table->uuid('kriteria_detail_id');
                $table->float('bobot')->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_siswa_details');
    }
}
