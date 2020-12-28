<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('slug',128);
            $table->boolean('is_main')->default(false);
            $table->string('type',64)->default('');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('category_id')->unsigned()->default(0);
            $table->integer('post_id')->unsigned()->default(0);
            $table->integer('position')->unsigned()->default(0);
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
        Schema::dropIfExists('menu_items');
    }
}
