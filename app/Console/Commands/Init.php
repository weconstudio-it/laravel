<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weconstudio:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init command for Weconstudio Laravel application';
    
    /**
     * Create a new command instance.
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
    public function handle()
    {
		$this->comment($this->description);

		$this->line("<info>Rrequirements:</info>\n<question>*</question> npm\n<question>*</question> bower");
		if(!$this->confirm('Do you wish to continue? [y|N]')) dd();

		$this->comment("Database connection...");
		$host = $this->ask('DB_HOST', $this->laravel['config']['database.connections.mysql.host']);
		$port = $this->ask('DB_PORT', $this->laravel['config']['database.connections.mysql.port']);
		$database = $this->ask('DB_DATABASE', basename(base_path()));
		$username = $this->ask('DB_USERNAME', $this->laravel['config']['database.connections.mysql.username']);
		$password = $this->ask('DB_PASSWORD', $this->laravel['config']['database.connections.mysql.password']);

		$this->comment("Setting enviroment variables...");
		$this->setEnv('DB_HOST', 'database.connections.mysql.host', $host);
		$this->setEnv('DB_PORT', 'database.connections.mysql.port', $port);
		$this->setEnv('DB_DATABASE', 'database.connections.mysql.database', $database);
		$this->setEnv('DB_USERNAME', 'database.connections.mysql.username', $username);
		$this->setEnv('DB_PASSWORD', 'database.connections.mysql.password', $password);

		if ($this->confirm('Do you wish to create database? (warning! no: use preesistent database) [y|N]')) {
			$this->comment('Check database...');
			try {
				\DB::table('user')->get();
				$this->error("The database already exists!");
				dd();
			} catch(\PDOException $e) {
				if($e->getCode() == 1049) {
					// The database does not exists
					$this->comment('Create database...');
					$mysql = new PDO("mysql:host={$host}", $username, $password);
					$mysql->prepare("CREATE DATABASE {$database} CHARACTER SET utf8 COLLATE utf8_general_ci;")->execute();
				} else {
					$this->error("The database already exists!");
					dd();
				}
			}

		}
		
		$this->comment('php artisan propel:migration:migrate');
		$this->call("propel:migration:migrate");

		$this->comment('php artisan propel:model:build');
		$this->call("propel:model:build");

		$this->comment('php artisan db:seed');
		$this->call("db:seed");

		$this->comment('npm install');
		$this->info(shell_exec('npm install'));

		$this->comment('bower update');
		$this->info(shell_exec('bower update'));

		$this->info("Done!");
    }

	/**
	 * Set the application key in the environment file.
	 *
	 * @param $key string
	 * @param $from string vecchio valore
	 * @param $to string nuovo valore da impostare
	 */
    protected function setEnv($key, $from, $to)
    {
        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            $key . '=' . $this->laravel['config'][$from],
            $key . '=' . $to,
            file_get_contents($this->laravel->environmentFilePath())
        ));

		$this->laravel['config'][$from] = $to;
    }
}
