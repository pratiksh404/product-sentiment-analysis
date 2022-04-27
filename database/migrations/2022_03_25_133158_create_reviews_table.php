<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('product_uuid');
            $table->string('review_author_name')->nullable();
            $table->dateTime('review_date');
            $table->boolean('recommended')->nullable();
            $table->integer('rating')->nullable();
            $table->string('review_title')->nullable();
            $table->text('review_text')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('product_uuid')->references('uuid')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
