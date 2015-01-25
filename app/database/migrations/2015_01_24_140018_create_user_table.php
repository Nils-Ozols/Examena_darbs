<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
            // default required columns
            $table->increments('id'); 
            $table->timestamps();
            // required column for Auth layer (in User only model)
            $table->rememberToken();
            // specific columns
            $table->string('username', 100);
            $table->string('email');
            $table->string('password', 60);
            $table->tinyInteger('class')->default(1);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
