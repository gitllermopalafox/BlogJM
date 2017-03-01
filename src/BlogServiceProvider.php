<?php namespace Machaen\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__ . '/../vendor/autoload.php';

		$this->loadViewsFrom(__DIR__.'/views', 'blog');
		$this->publishes([ __DIR__.'/views' => base_path('resources/views/vendor/blog')]);
		$this->publishes([ __DIR__.'/database/migrations' => base_path('database/migrations')]);
		$this->publishes([ __DIR__.'/database/seeds' => base_path('database/seeds')]);
		$this->publishes([ __DIR__.'/public/css' => base_path('public/css')]);
		$this->publishes([ __DIR__.'/public/js' => base_path('public/js')]);
		$this->publishes([ __DIR__.'/public/styl' => base_path('resources/assets/styl')]);
		$this->publishes([ __DIR__.'/public/images/blog' => base_path('public/images/blog')]);
		$this->publishes([ __DIR__.'/public/uploads/blog' => base_path('public/uploads/blog')]);
		$this->publishes([ __DIR__.'/config' => base_path('config')]);
		$this->publishes([ __DIR__.'/lang/en' => base_path('resources/lang/en')]);
		$this->publishes([ __DIR__.'/lang/es' => base_path('resources/lang/es')]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		include __DIR__.'/routes.php';
		
		$this->app->make('Machaen\Blog\BlogController');

	}

}