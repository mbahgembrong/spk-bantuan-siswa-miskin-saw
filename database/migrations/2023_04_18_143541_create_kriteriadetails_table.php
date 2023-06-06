<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriadetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteriadetails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kriteria_id');
            $table->string('nama');
            $table->float('bobot');
            $table->string('kode')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('kriteriadetails', function (Blueprint $table) {
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kriteriadetails');
    }
}
