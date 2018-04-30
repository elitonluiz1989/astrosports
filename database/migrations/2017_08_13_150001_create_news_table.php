<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned()->nullable();
            $table->string('cover')->nullable();
            $table->string('title');
            $table->text('text');
            $table->timestamps();
        });

        Schema::table('news', function($table) {
            $table->foreign('author')
                ->references('id')
                ->on('authors')
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
        Schema::dropIfExists('news');
    }
}
