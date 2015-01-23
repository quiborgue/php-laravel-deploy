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
		$this->registerDeploy();
	}

	private function registerDeploy() {
		$this->app['deploy.deploy'] = $this->app->share(function($app)
        {
            return new DeployCommand;
        });
        $this->commands('deploy.deploy');
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
