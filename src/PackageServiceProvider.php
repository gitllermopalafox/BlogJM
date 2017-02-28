<?php namespace Machaen\Blog;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__ . '/../vendor/autoload.php';

		$this->loadViewsFrom(__DIR__.'/views', 'packages');
		$this->publishes([ __DIR__.'/views' => base_path('resources/views/machaen/blog')]);
		$this->publishes([ __DIR__.'/database/migrations' => base_path('database/migrations')]);
		$this->publishes([ __DIR__.'/database/seeds' => base_path('database/seeds')]);
		$this->publishes([ __DIR__.'/public/css' => base_path('public/css')]);
		$this->publishes([ __DIR__.'/public/js' => base_path('public/js')]);
		$this->publishes([ __DIR__.'/resources/assets/styl' => base_path('public/styl')]);
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
