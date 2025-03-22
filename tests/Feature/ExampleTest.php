<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

        public function test_get_()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_xaca()
    {
        $response = Category::all();

        $this->assertIsObject($response);
    }
}
