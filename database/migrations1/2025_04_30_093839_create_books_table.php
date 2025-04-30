<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('title');
            $table->string('publisher');
            $table->integer('year');
            $table->integer('quantity');
            $table->string('category');
            $table->string('volume')->nullable();
            $table->string('author1');
            $table->string('author2')->nullable();
            $table->string('author3')->nullable();
            $table->string('author4')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
