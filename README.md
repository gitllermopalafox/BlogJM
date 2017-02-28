BLOG MACHAEN
=======================
Blog básico con traducciones para laravel 5.

Instalación
-------

1- Agregar al archivo `composer.json` el plugin y version del mismo, en este caso quedaría de la siguiente manera:

```json
{
    "require": {
        "machaen/blog": "dev-master"
    }
}
```
2- Agregar nuestros "providers" y "aliases" al archivo `config/app.php`:

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
    	'LaravelLocalization'   => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization'
	]
```
3- Publicar los archivos de nuestro blog mediante el siguiente comando en la linea de comandos:
```php
php artisan vendor:publish
```
4- Importar el archivo `blog.css` en nuestro proyecto, el cual se ubica en `public/css/blog.css`:
```html
<head>
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">  
</head>
```