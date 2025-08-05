<?php

namespace Azzarip\ApiBasicAuth;

use Illuminate\Routing\Router;
use Spatie\LaravelPackageTools\Package;
use Azzarip\ApiBasicAuth\Commands\ApiBasicAuthCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ApiBasicAuthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('api-basic-auth');
    }

    public function packageBooted() {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('api.auth', ApiBasicAuthMiddleware::class);
    }
}
