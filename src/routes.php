<?php

Route::get('blog', ['as' => 'blog.index', 'uses' => 'Machaen\Blog\BlogController@index']);

Route::get('blog/{slug}', ['as' => 'blog.show', 'uses' => 'Machaen\Blog\BlogController@show']);