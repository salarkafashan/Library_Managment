<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable();
            $table->foreignId('publisher_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('age_id')->nullable();
            $table->foreignId('shelf_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('pages')->nullable();
            $table->string('stock')->nullable();
            $table->string('Language')->nullable();
            $table->string('weight')->nullable();
            $table->string('Dimensions')->nullable();
            $table->string('reward')->nullable();
            $table->timestamp('release_date')->nullable();
            $table->string('cover_image')->nullable();
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
        Schema::dropIfExists('books');
    }
}
