<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id')->unsigned();
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->integer('daerah_id')->unsigned();
            $table->foreign('daerah_id')->references('id')->on('daerah');
            $table->integer('kelompok_id')->unsigned();
            $table->foreign('kelompok_id')->references('id')->on('kelompok');
            $table->string('name',50);
            $table->string('addres',100);
            $table->string('phone',14);
            $table->date('birthday',100);
            $table->string('status',20);
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
        Schema::dropIfExists('people');
    }
}
