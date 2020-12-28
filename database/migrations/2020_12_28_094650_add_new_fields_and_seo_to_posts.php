<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsAndSeoToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->boolean('is_show')->default(true);
            $table->boolean('is_recomend')->default(false);
            $table->string('seo_meta_title',256)->default('');
            $table->text('seo_meta_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_og_image')->nullable();
            $table->text('seo_meta_twitter_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');
            $table->dropColumn('is_show');
            $table->dropColumn('is_recomend');
            $table->dropColumn('seo_meta_title');
            $table->dropColumn('seo_meta_description');
            $table->dropColumn('seo_keywords');
            $table->dropColumn('seo_og_image');
            $table->dropColumn('seo_meta_twitter_image');
        });
    }
}
