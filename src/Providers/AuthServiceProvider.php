<?php

namespace GrassFeria\StarterkidWiki\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \GrassFeria\StarterkidWiki\Models\Wiki::class => \GrassFeria\StarterkidWiki\Policies\WikiPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}