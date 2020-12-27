<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug',128);
            $table->integer('category_id')->unsigned()->default(0);
            $table->integer('length')->unsigned()->default(0);
            $table->integer('price')->unsigned()->default(0);
            $table->string('type',32);
            $table->string('phones',128);
            $table->string('work_times',128);
            $table->string('email',128);
            $table->string('link',128);
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
        Schema::dropIfExists('posts');
    }
}
