<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMainAdminPage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Админ');
    }

    public function testCat() {
        $response = $this->get('/news/categories');
        $response->assertStatus(200);
    }

}
