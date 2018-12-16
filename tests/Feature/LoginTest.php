<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuth()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/login', ['email' => 'patientco@gmail.com', 'password' => 123 ]);

        $response
            ->assertStatus(200);
    }
}
