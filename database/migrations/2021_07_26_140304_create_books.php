<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooks extends Migration
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
            $table->string('name', 100);
            $table->text('description', 100);
            $table->unsignedMediumInteger('type_id');
            $table->string('author', 100);
            $table->string('publisher',100)->nullable();
            $table->unsignedInteger('publication_year')->nullable();
            $table->id('country_id')->nullable();
            $table->string('book_image', 100)->nullable();
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