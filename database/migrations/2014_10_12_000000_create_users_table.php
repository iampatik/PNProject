<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 60)->unique()->nullable(false);
            $table->string('FirstName', 60)->nullable(false);
            $table->string('MiddleName', 60)->nullable(false);
            $table->string('LastName', 60)->nullable(false);
            $table->string('Suffix', 10)->nullable();
            $table->string('Email', 60)->unique()->nullable(false);
            $table->string('Password', 60)->nullable(false);
            $table->enum('Gender', ['Male','Female'])->nullable(false);
            $table->rememberToken()->nullable(false);
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