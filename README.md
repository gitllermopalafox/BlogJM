BLOG MACHAEN
=======================
Blog básico con traducciones para laravel 5.

Instalación y configuración
-------

1 - Agregar al archivo `composer.json` el plugin y version del mismo, en este caso quedaría de la siguiente manera:

```json
{
    "require": {
        "machaen/blog": "dev-master"
    }
}
```
2 - Agregar nuestros "providers" y "aliases" al archivo `config/app.php`:

```php
'providers' => [
		'Illuminate\Html\HtmlServiceProvider',
		'Dimsav\Translatable\TranslatableServiceProvider',
		'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
		'Machaen\Blog\PackageServiceProvider',
	]
	.....
'aliases' => [
    	'Form'                  => 'Illuminate\Html\FormFacade',
    	'LaravelLocalization'   => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization',
    	'HelpersMachaen'   		=> 'App\HelpersMachaen',
	]
```
3 - Publicar los archivos de nuestro blog mediante el siguiente comando en la linea de comandos:
```php
php artisan vendor:publish
```
4 - Importar el archivo `blog.css` en nuestro proyecto, el cual se ubica en `public/css/blog.css`:
```html
<head>
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">  
</head>
```
5 - Agregar los "middlewares" al archivo `app/Http/kernel.php`, los cuales ayudarán a con el manejo de las rutas y traducciones:
```php
...
protected $routeMiddleware = [
	'localize'              => '\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes',
	'localizationRedirect'  => '\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter',
	'localeSessionRedirect' => '\Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect'
];
```
6 - Agregar rutas en el archivo `app/Http/routes.php`:

```php

/******** Other routes *********/

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