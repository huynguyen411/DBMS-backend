<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('role_id')->default(1);
            $table->string('name', 101);
            // $table->string('phone', 20)->nullable();
            $table->string('address', 101)->default('unknown');
            $table->string('email', 101)->unique();
            // $table->date('dob')->default('1970-01-01');
            // $table->dateTime('created_at')->nullable();
            // $table->dateTime('update_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('image_avatar',100)->nullable();
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
        Schema::dropIfExists('users');
    }
}
