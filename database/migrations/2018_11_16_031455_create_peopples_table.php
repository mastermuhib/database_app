<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peopples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desas_id')->unsigned();
            $table->foreign('desas_id')->references('id')->on('desas');
            $table->integer('daerahs_id')->unsigned();
            $table->foreign('daerahs_id')->references('id')->on('daerahs');
            $table->integer('kelompoks_id')->unsigned();
            $table->foreign('kelompoks_id')->references('id')->on('kelompoks');
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
        Schema::table('peopples', function (Blueprint $table) {
            //
        });
    }
}
