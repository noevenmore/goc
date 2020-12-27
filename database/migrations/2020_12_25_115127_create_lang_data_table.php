<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_data', function (Blueprint $table) {
            $table->id();
            $table->integer('lang_id')->unsigned();
            $table->integer('data_id')->unsigned();
            $table->string('type',32);
            $table->string('name',128);
            $table->string('addr',255);
            $table->text('text');
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
        Schema::dropIfExists('lang_data');
    }
}
