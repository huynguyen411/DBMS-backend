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
            $table->bigIncrements('book_id');
            $table->string('name_book', 100);
            $table->unsignedMediumInteger('type_id');
            $table->string('author', 100);
            $table->string('translator', 100)->nullable();
            $table->string('publisher',100)->nullable();
            $table->date('publication_date')->nullable();
            // $table->integer('publication_country_id')->nullable();
            // $table->unsignedSmallInteger('language_id')->nullable();
            $table->decimal('price', $precision = 18, $scale = 4)->nullable();
            $table->string('isbn', 20)->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('review', 1000)->nullable();
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
