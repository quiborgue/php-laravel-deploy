<?php
namespace Quiborgue\LaravelDeploy\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class DeployCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'deploy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deploy application to selected stage';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$appName = 'garra-parser';
		$release = Carbon::now()->getTimestamp();
		$basePath = '/var/www';
		$appPath = "$basePath/$appName";
		$branch = 'featured';
		$gitUrl = 'git@bitbucket.org:quiborgue/garra-parser.git';
		$releasePath = "$appPath/releases/$release";
		$ownership = "www-data:www-data";

		$writables = array();

		$shareds = array(
			'app/storage/sessions',
			'app/storage/logs',
			'app/database/production.sqlite'
		);

		$commandList = array();
		$commandList[] = "export LARAVEL_ENV=production";
		$commandList[] = "env";
		$commandList[] = "mkdir -p $releasePath";
		$commandList[] = "git clone --depth 1 -b $branch \"$gitUrl\" $releasePath";

		$commandList[] = "cd $releasePath";
		$commandList[] = "composer install --no-interaction --no-dev --prefer-dist";

		foreach ($shareds as $shared) {
			$commandList[] = "rm -rf $releasePath/$shared";
			$commandList[] = "ln -s $appPath/shared/$shared $releasePath/$shared";
		}

		foreach ($writables as $writable) {
			$commandList[] = "chmod -R 755 $releasePath/$writable";
			$commandList[] = "chmod -R g+s $releasePath/$writable";
			$commandList[] = "chown -R $ownership $releasePath/$writable";
		}

		$commandList[] = "rm -f $appPath/current";
		$commandList[] = "ln -s $releasePath $appPath/current";
		$commandList[] = "php artisan migrate --force";

		$this->runCommandList($commandList);

	}

	private function runCommandList($commandList) {
		$this->info("Will run following commands:");
		foreach ($commandList as $command) {
			$this->info($command);
		}
		SSH::run($commandList);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
