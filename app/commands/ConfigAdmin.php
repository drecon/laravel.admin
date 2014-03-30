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

		if ($this->confirm('Do you remove comments in (providers and aliases) app/config/app.php? [yes|no]'),false)
		{
			$this->info('Aborted config.');	
			
			return;
		}
		exec ( "composer update" );
		
		if ($this->confirm('Do you configurate app/config/database.php? [yes|no]'),false)
		{
			$this->info('Aborted config.');	
			
			return;
		}

		if ($this->confirm('Do you import yout database? [yes|no]'),false)
		{
			$this->info('Aborted config.');	
			
			return;
		}
		
		$this->info('Creating user account...');

		$name = $this->ask('What is admin name?');

		$email = $this->ask('What is admin e-email?');

		$password = $this->secret('What is the admin password?');		
		
		//criar tabela de usuários
		exec ( "php artisan syntara:install" );
		exec ( "php artisan create:user {$name} {$email} {$password} admin" );

		//criar modais em cima do banco de dados
		exec ( "php artisan larry:fromdb --except=users" );
		
		$this->info('Created!');								

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

