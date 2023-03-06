<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $params=[
            'name'=>'Murazik',
            'color'=>'green'
        ];
        $response = $this->get(route('data',$params));

        $response->assertOk();
    }
}
