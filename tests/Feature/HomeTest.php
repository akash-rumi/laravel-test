<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageworkingCorrectly()
    {
        $response = $this->get('/');

        $response = assertSeeText('Laravel Testing by AKASH');
        $response->assertStatus(200);
    }

    public function testContactPageWorkingCorrectly()
    {
        $response = $this->get('/contact');
        $response = assertEmpty('jkbvk');

        $response = assertSeeText('Contact US');
    }
}
