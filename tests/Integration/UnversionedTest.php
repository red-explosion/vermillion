<?php

namespace Square\Vermillion\Tests\Integration;

use Square\Vermillion\Tests\TestCase;

class UnversionedTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test404()
    {
        $response = $this->get('/');
        $response->assertStatus(404);
    }

    public function testUnversioned()
    {
        $response = $this->get('/api/unversioned');
        $response->assertStatus(200);
        $this->assertEquals('unversioned', $response->getContent());
    }
}
