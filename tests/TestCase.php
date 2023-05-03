<?php

declare(strict_types=1);

namespace Square\Vermillion\Tests;

use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as Orchestra;
use Square\Vermillion\Tests\fixtures\MembersController;
use Square\Vermillion\Tests\fixtures\UsersController;
use Square\Vermillion\VersioningServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            VersioningServiceProvider::class,
        ];
    }

    protected function defineRoutes($router): void
    {
        $router
            ->middleware('api')
            ->prefix('api')
            ->group(function (Router $router): void {
                $router->get('/unversioned', fn () => 'unversioned');

                $router->versioned()->group(function (Router $router): void {
                    $router->get('/users', [UsersController::class, 'listUsers'])->name('users.list')
                        ->apiVersion('3', [UsersController::class, 'listUsersV3'])
                        ->apiVersion('4', [UsersController::class, 'listUsersV4'])
                        ->apiVersion('7', $router->versioning()->unsupported());

                    $router->get('/users/{id}', [UsersController::class, 'show'])->name('users.show');

                    $router->post('/members', $router->versioning()->methodNotAllowed())->name('member.create')
                        ->apiVersion('3', [MembersController::class, 'create']);
                });
            });
    }
}
