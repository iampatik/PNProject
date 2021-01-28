<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeklyTask', function (Blueprint $table) {
            $table->string('id', 40)->nullable(false);
            $table->string('TaskID')->nullable(false);
            $table->string('StudentID')->nullable(false);
            $table->string('Coordinator')->nullable(false);
            $table->string('MakerID')->nullable(false);
            $table->string('Center', 10)->nullable(false);
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
        Schema::dropIfExists('weeklyTask');
    }
}