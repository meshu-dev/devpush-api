<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_category_id');
            $table->string('name');
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_post_id');
            $table->unsignedBigInteger('wp_category_id');
            $table->string('slug');
            $table->timestamps();
        });

        /*
        Schema::create('post_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_featured_media_id');
            $table->text('source_image_url');
            $table->json('sizes');
            $table->timestamps();
        }); */
    }

    public function down(): void
    {
        Schema::dropIfExists('post_categories');
        //Schema::dropIfExists('post_thumbnails');
        Schema::dropIfExists('posts');
    }
};
