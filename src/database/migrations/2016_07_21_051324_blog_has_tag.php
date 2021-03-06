<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogHasTag extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_has_tag', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blog_id')->unsigned();
			$table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
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
		Schema::drop('blog_has_tag');
	}

}
