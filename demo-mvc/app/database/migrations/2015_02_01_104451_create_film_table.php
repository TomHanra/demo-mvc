<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('genre')->nullable();
			$table->integer('release_year');
			$table->integer('review_stars')->nullable();
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
		Schema::drop('film');
	}

}
