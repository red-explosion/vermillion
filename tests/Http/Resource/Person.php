<?php

declare(strict_types=1);

namespace Square\Vermillion\Tests\Http\Resource;

class Person
{
    public string $name;

    public int $age;

    public string $nickName;

    public ?array $hobbies = null;
}
