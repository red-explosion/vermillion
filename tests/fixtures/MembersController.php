<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\fixtures;

use Illuminate\Http\Response;

final class MembersController
{
    public function create(): Response
    {
        return new Response(__METHOD__, Response::HTTP_CREATED);
    }
}
