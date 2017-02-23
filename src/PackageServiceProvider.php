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
