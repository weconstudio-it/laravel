<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        /**
         * Comandi da lanciare:
         * inizializzazione DB
         * php artisan propel:migration:migrate
         * php artisan propel:model:build
         * php artisan db:seed
         * npm install [check npm]
         * bower update [check bower]
         */
    }

    /**
     * Set the application key in the environment file.
     *
     * @param  string  $key
     * @return void
     */
    protected function setKeyInEnvironmentFile($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            'APP_KEY='.$this->laravel['config']['app.key'],
            'APP_KEY='.$key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }
}
