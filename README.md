BLOG MACHAEN
=======================
Simple plugin to generate an enviroment blog

Installation and configuration
-------

1 - Add to file `composer.json` the next line and eject a composer update:

```json
{
    "require": {
        "machaen/blog": "dev-master"
    }
}
```
2 - Add the providers and aliases necessary to file `config/app.php`:

```php
'providers' => [
		'Illuminate\Html\HtmlServiceProvider',
		'Dimsav\Translatable\TranslatableServiceProvider',
		'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
		'Machaen\Blog\BlogServiceProvider',
	]
	.....
'aliases' => [
    	'Form'                  => 'Illuminate\Html\FormFacade',
    	'LaravelLocalization'   => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization',
	]
```
3 - Public files whith the next command:
```php
php artisan vendor:publish
```
4 - Import files `blog.css` and `blog.js` inside our project:
```html
<head>
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">  
    <script src="{{ asset('js/blog.js') }}"></script>  
</head>
```
5 - Add middlewares to `app/Http/kernel.php`:
```php
...
protected $routeMiddleware = [
	'localize'              => '\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes',
	'localizationRedirect'  => '\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter',
	'localeSessionRedirect' => '\Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect'
];
```
6 - Add routes to `app/Http/routes.php`:

```php
/*** 
Other routes
.............
 ***/
 
Route::group(
[
	'prefix' 		=> LaravelLocalization::setLocale(),
	'middleware' 	=> [ 'localeSessionRedirect', 'localizationRedirect' ]
],
function(){
    Route::get(LaravelLocalization::transRoute('blog.blog-index'),['as' => 'blog.index', 'uses' => '\Machaen\Blog\BlogController@index']);
    Route::get(LaravelLocalization::transRoute('blog.blog-show'),['as' => 'blog.show', 'uses' => '\Machaen\Blog\BlogController@show']);
});
```
7 - Finally you have to migrate and insert your seeds:
```php
	php artisan migrate:refresh --seed
```

Translations button
-------
It's necessary configure a button that's allow change our locale and set the lenguage (only in the preview post). So, we have to insert the next condition inside our action link, for example:

```php

	/*----------  PREVIEW BLOG POST  ----------*/
	
	/* This line call the function "getRouteBlog" that's create a link with the parameters necessary for translate the current route. Here we past the route at layout our project */
	@extends('layout', ['route_blog' => \Machaen\Blog\Helpers::getRouteBlog($post->id)])

	/*----------  LAYOUT  ----------*/
	
	@if(LaravelLocalization::getCurrentLocale() == 'en')
      <a href="{{ isset($route_blog) ? $route_blog : LaravelLocalization::getLocalizedURL('es') }}">ESPAÑOL</a>
    @else
      <a href="{{isset($route_blog) ? $route_blog : LaravelLocalization::getLocalizedURL('en') }}">ENGLISH</a>
    @endif
	
```
