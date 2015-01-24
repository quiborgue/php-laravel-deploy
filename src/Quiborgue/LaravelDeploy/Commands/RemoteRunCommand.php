<?php
namespace Quiborgue\LaravelDeploy\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RemoteRunCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'deploy:run';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run following command on remote host';

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
		\SSH::run($this->argument('remoteCommand'));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('remoteCommand', InputArgument::REQUIRED, 'The command to run.'),
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
			// array('command', null, InputOption::VALUE_OPTIONAL, 'The command to run.', null),
		);
	}

}
