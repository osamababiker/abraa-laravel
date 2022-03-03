<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertOk();

        $response->assertSessionHasError('');

        $response->assertRedirect('/');

        $response->assertEquals('0', '0');

        $response->assertInstanceOf(Carbon::class, '');
    }
}
