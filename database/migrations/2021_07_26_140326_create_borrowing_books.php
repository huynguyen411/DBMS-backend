<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_books', function (Blueprint $table) {
            $table->bigIncrements('borrowing_book_id');
            $table->unsignedBigInteger('book_id');
            // $table->unsignedSmallInteger('quality');
            $table->unsignedBigInteger('borrower_id');
            $table->dateTime('from_date');
            $table->dateTime('to_date')->nullable();
            $table->dateTime('promissory_date');
            $table->unsignedTinyInteger('status_id');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowing_books');
    }
}
