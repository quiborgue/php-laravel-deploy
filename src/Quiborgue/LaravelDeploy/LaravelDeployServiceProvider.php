<?php 
namespace Quiborgue\LaravelDeploy;

use Illuminate\Support\ServiceProvider;
use Quiborgue\LaravelDeploy\Commands\DeployCommand;

class LaravelDeployServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot() {
		 $this->package('quiborgue/laravel-deploy');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		Artisan::add(new DeployCommand);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
