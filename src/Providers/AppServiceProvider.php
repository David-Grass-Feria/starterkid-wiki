<?php

namespace GrassFeria\StarterkidWiki\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use GrassFeria\StarterkidWiki\Console\Commands\InstallStarterkidWikiCommand;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->mergeConfigFrom(
            __DIR__.'/../../config/starterkid-wiki.php', 'starterkid-wiki'
        );
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        // middleware
        //$router = $this->app['router'];
        //$router->aliasMiddleware('cache', \GrassFeria\StarterkidWiki\Http\Middleware\MyMiddlewareName::class);
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'starterkid-wiki');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../../lang');
        Livewire::component('starterkid-wiki::wiki-create',\GrassFeria\StarterkidWiki\Livewire\Wiki\WikiCreate::class);
        Livewire::component('starterkid-wiki::wiki-edit',\GrassFeria\StarterkidWiki\Livewire\Wiki\WikiEdit::class);
        Livewire::component('starterkid-wiki::wiki-index',\GrassFeria\StarterkidWiki\Livewire\Wiki\WikiIndex::class);
        Livewire::component('starterkid-wiki::front-wiki-index',\GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiIndex::class);
        Livewire::component('starterkid-wiki::front-wiki-show',\GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiShow::class);
       
        $this->publishes([
            __DIR__.'/../../stubs' => base_path('/'),
        ], 'starterkid-wiki');



        // commands
        $this->commands([
            InstallStarterkidWikiCommand::class,
            
        ]);

        // scheduler
        //$this->app->booted(function () {
        //    $schedule = $this->app->make(Schedule::class);
        //    $schedule->command('backup:run')->everyFiveMinutes();
        //    
        //});

        

       //$this->app->config->set('filesystems.disks.dog', [
       //     'driver' => env('DOG_DISK', 'local'),
       //     'root' => env('DOG_DISK') == 'sftp' ? 'dogs' : (env('DOG_DISK') == 'local' ? storage_path('app/dogs') : null),
       //     // for sftp
       //     'host' => env('DOG_DISK') == 'sftp' ? env('STORAGEBOX_HOST', '') : null,
       //     'username' => env('DOG_DISK') == 'sftp' ? env('STORAGEBOX_USERNAME', '') : null,
       //     'password' => env('DOG_DISK') == 'sftp' ? env('STORAGEBOX_PASSWORD', '') : null,
       //     'visibility' => 'private',
       //     'directory_visibility' => 'private',
       //     'maxTries' => env('DOG_DISK') == 'sftp' ? 4 : null,
       //     'port' => env('DOG_DISK') == 'sftp' ? 22 : null,
       //     'timeout' => env('DOG_DISK') == 'sftp' ? 30 : null,
       //     'useAgent' => env('DOG_DISK') == 'sftp' ? false : null,
       //     // for s3
       //     'key' => env('DOG_DISK') == 's3' ? env('AWS_ACCESS_KEY_ID') : null,
       //     'secret' => env('DOG_DISK') == 's3' ? env('AWS_SECRET_ACCESS_KEY') : null,
       //     'region' => env('DOG_DISK') == 's3' ? env('AWS_DEFAULT_REGION') : null,
       //     'bucket' => env('DOG_DISK') == 's3' ? env('AWS_BUCKET') : null,
       //     'url' => env('DOG_DISK') == 's3' ? env('AWS_URL') : null,
       // ]);
        


       
    }
}