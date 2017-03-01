BLOG MACHAEN
=======================
Blog básico con traducciones para laravel 5.

Instalación y configuración
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
5 - Add middlewarest to `app/Http/kernel.php`:
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
6 - Finally you have to migrate and insert your seeds:
```php
php artisan vendor:publish
```