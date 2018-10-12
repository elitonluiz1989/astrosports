<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hour');
            $table->string('day');
            $table->integer('pole')->unsigned()->nullable();
            $table->integer('category')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('schedules', function($table) {
            $table->foreign('pole')
                ->references('id')
                ->on('schedules_poles')
                ->onDelete('set null');
            $table->foreign('category')
                ->references('id')
                ->on('schedules_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
