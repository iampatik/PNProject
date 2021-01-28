<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->string('id', 100)->unique()->nullable(false);
            $table->string('TaskName', 30)->nullable(false);
            $table->enum('Center', ['Center1', 'Center2'])->nullable(false);
            $table->enum('Difficulty', ['Easy', 'Hard'])->nullable(false);
            $table->integer('NoOfStudents')->nullable(false);
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
        Schema::dropIfExists('tasks');
    }
}