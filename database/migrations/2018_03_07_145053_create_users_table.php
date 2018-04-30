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
            $table->increments('id');
            $table->string('username', 80)->unique();
            $table->string('name')->nullable();
            $table->text('avatar')->nullable();
            $table->string('password');
            $table->integer('role')->unsigned()->nullable();
            $table->integer('grant')->unsigned()->nullable();
            $table->timestamps();
            $table->rememberToken();
        });

        Schema::table('users', function($table) {
            $table->foreign('role')
                ->references('id')
                ->on('user_roles')
                ->onDelete('set null');

            $table->foreign('grant')
                ->references('id')
                ->on('user_grants')
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
        Schema::dropIfExists('users');
    }
}
