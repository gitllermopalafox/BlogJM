<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_translations', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('titulo');
		    $table->longtext('descripcion');
		    $table->longtext('previo');
		    $table->string('slug');
		    $table->string('image_banner');  
		    $table->string('locale')->index();
		    $table->integer('blog_id')->unsigned();
		    $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
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
		Schema::drop('blog_translations');
	}

}
