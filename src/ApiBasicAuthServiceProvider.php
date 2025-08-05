<?php

namespace Azzarip\ApiBasicAuth;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPackageTools\Package;
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

    public function packageBooted()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('api.auth', ApiBasicAuthMiddleware::class);

        Http::macro('user', function (string $user) {
            $password = config("services.{$user}.outbound_password");
            $baseUrl = rtrim(config("services.{$user}.entrypoint"), '/');

            return Http::withBasicAuth($user, $password)
                ->retry(5, 100)
                ->baseUrl($baseUrl);
        });
    }
}
