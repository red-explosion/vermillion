<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests;

use Illuminate\Config\Repository;
use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as Orchestra;
use RedExplosion\Vermillion\Tests\fixtures\MembersController;
use RedExplosion\Vermillion\Tests\fixtures\UsersController;
use RedExplosion\Vermillion\VermillionServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            VermillionServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        tap($app->make('config'), function (Repository $config): void {
            $config->set('vermillion.latest', 't');
            $config->set('vermillion.max', '7');
        });
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
