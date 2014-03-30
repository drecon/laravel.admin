<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ConfigAdmin extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:configAdmin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Config Adm. System.';

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
		//App::bind('Acme\Product\Anvil\teste', 'Acme\Product\Anvil\teste2');
		//App::register('Mrjuliuss\Syntara\SyntaraServiceProvider');
		$this->info('Config Adm. System!');
		$this->info('...................................');
		
		if ($this->confirm('Do you configurate your database? [yes|no]'))
		{
		
			$this->info('Creating user account...');

			$name = $this->ask('What is admin name?');

			$email = $this->ask('What is admin e-email?');

			$password = $this->secret('What is the admin password?');		
			
			exec ( "php artisan syntara:install" );
			exec ( "php artisan create:user {$name} {$email} {$password} admin" );
						
			$this->info('Created!');		
			
		}else{
		
			$this->info('Aborted config.');	
			
		}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
		
	}

}

