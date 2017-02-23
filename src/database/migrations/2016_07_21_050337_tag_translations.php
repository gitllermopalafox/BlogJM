<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TagTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('slug');
			$table->string('locale')->index();
			$table->integer('tag_id')->unsigned();
		    $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');
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
		Schema::drop('tag_translations');
	}

}
