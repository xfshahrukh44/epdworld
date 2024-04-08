<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('productreviews')) {
            Schema::create('productreviews', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('name')->nullable();
                $table->string('designation')->nullable();
                $table->string('rating')->nullable();
                $table->text('review')->nullable();
                $table->string('product_id')->nullable();
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productreviews');
    }
}
