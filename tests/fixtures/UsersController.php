<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\fixtures;

use Illuminate\Http\Request;
use RedExplosion\Vermillion\ApiVersion;
use RedExplosion\Vermillion\Formats\Numeric\NumericVersion;

final class UsersController
{
    /**
     * @param Request $request
     * @param NumericVersion $v
     * @return string
     */
    public function listUsers(Request $request, ApiVersion $v): string
    {
        return __METHOD__;
    }

    public function listUsersV3(Request $request): string
    {
        return __METHOD__;
    }

    public function listUsersV4(Request $request): string
    {
        return __METHOD__;
    }

    /**
     * @param Request $request
     * @param string $id
     * @return string
     */
    public function show(Request $request, mixed $id): string
    {
        // Used in assertions checking that current API version is inferred during route generation,
        // and positional arguments are current even without $apiVersion in the action's arg list.
        return route('users.show', [
            'id' => $id,
        ]);
    }
}
