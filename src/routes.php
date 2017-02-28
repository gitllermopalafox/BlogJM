<?php

//Route::get('blog', ['as' => 'blog.index', 'uses' => 'Machaen\Blog\BlogController@index']);

//Route::get('blog/{slug}', ['as' => 'blog.show', 'uses' => 'Machaen\Blog\BlogController@show']);

Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
	],
	function(){
	    Route::get(LaravelLocalization::transRoute('blog.blog-index'),['as' => 'blog.index', 'uses' => 'Machaen\Blog\BlogController@index']);
	    Route::get(LaravelLocalization::transRoute('blog.blog-show'),['as' => 'blog.show', 'uses' => 'Machaen\Blog\BlogController@show']);
	});