<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('carts', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');;
        // });
        // Schema::table('carts', function (Blueprint $table) {
        //     $table->foreign('book_id')->references('book_id')->on('books')->onUpdate('no action')->onDelete('no action');;
        // });
        // //
        // Schema::table('borrowing_books', function (Blueprint $table) {
        //     $table->foreign('book_id')->references('book_id')->on('books')->onUpdate('no action')->onDelete('no action');;
        // });
        // Schema::table('borrowing_books', function (Blueprint $table) {
        //     $table->foreign('borrower_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');;
        // });
        // //
        // Schema::table('comments', function (Blueprint $table) {
        //     $table->foreign('borrower_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');;
        // });
        // Schema::table('comments', function (Blueprint $table) {
        //     $table->foreign('book_id')->references('book_id')->on('books')->onUpdate('no action')->onDelete('no action');;
        // });
        
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
