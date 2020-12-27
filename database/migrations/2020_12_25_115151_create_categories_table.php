<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',128);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->boolean('is_show_addr')->default(true);
            $table->boolean('is_show_phone')->default(true);
            $table->boolean('is_show_link')->default(true);
            $table->boolean('is_show_email')->default(true);
            $table->boolean('is_show_work_times')->default(true);
            $table->boolean('is_show_price')->default(true);
            $table->boolean('is_show_length')->default(true);
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
        Schema::dropIfExists('categories');
    }
}
