<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\Integration;

use RedExplosion\Vermillion\Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    /**
     * @dataProvider dataAwarenessInControllerAction
     * @param string $url
     */
    public function testAwarenessInControllerAction(string $url): void
    {
        $response = $this->get($url);
        $response->assertStatus(200);
        $this->assertEquals('http://localhost' . $url, $response->getContent());
    }

    public function testGenerateSpecificVersion(): void
    {
        $url = route('users.list', [
            'apiVersion' => '3',
        ], false);
        $this->assertEquals('/api/v3/users', $url);
    }

    public function testDefaultToStable(): void
    {
        $url = route('users.list', [], false);
        $this->assertEquals('/api/v6/users', $url);
    }

    public static function dataAwarenessInControllerAction()
    {
        for ($v = 1; $v <= 7; $v++) {
            $randId = rand(1, 100);
            yield 'controller-action awareness @ v' . $v => [
                sprintf('/api/v%s/users/%d', $v, $randId),
            ];
        }
    }
}
