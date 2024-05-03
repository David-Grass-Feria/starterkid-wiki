<?php

namespace GrassFeria\StarterkidWiki\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\UniqueConstraintViolationException;

class InstallStarterkidWikiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkid-wiki:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the StarterkidWiki Plugin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
       
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('vendor:publish', ['--provider'=> 'GrassFeria\StarterkidWiki\Providers\AppServiceProvider','--force' => true]);
            
            //try {
            //Artisan::call('db:seed', ['class'=> 'GrassFeria\\StarterkidWiki\\Database\\Seeders\\WikiSeeder']);
            //}catch(UniqueConstraintViolationException){
            //    $this->info('success');
            //}

            return $this->info('GREAT! StarterkidWiki INSTALLED..');
       
        
       
    }

    

    
}
