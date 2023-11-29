<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryEndpointsTest extends TestCase
{
    public function test_inventory_starships_set_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/set', [
            'id' => 15, 
            'quantity' => 15, 
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'movement',
                'current_quantity',
                'ship_url',
                'updated_at',
                'created_at',
                'id',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'movement' => '15',
                'current_quantity' => '15',
                'ship_url' => 'https://swapi.dev/api/starships/15/',
            ],
        ]);
    }

    public function test_inventory_starships_set_quantity_endpoint_not_found()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/set', [
            'id' => 1, 
            'quantity' => 10, 
        ]);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'detail',
        ]);

        $response->assertJson([
            'detail' => 'Not found',
        ]);
    }

    public function test_inventory_starships_set_quantity_endpoint_error_in_params()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/set', [
            'id' => -1, 
            'quantity' => 10, 
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_inventory_vehicles_set_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/set', [
            'id' => 16, 
            'quantity' => 2, 
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'movement',
                'current_quantity',
                'ship_url',
                'updated_at',
                'created_at',
                'id',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'movement' => '2',
                'current_quantity' => '2',
                'ship_url' => 'https://swapi.dev/api/vehicles/16/',
            ],
        ]);
    }

    public function test_inventory_vehicles_set_quantity_endpoint_not_found()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/set', [
            'id' => 16123, 
            'quantity' => 2, 
        ]);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'detail',
        ]);

        $response->assertJson([
            'detail' => 'Not found',
        ]);
    }

    public function test_inventory_vehicles_set_quantity_endpoint_error_in_params()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/set', [
            'id' => 16, 
            'quantity' => -2, 
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_inventory_starships_add_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/set', [
            'id' => 2, 
            'quantity' => 0, 
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'movement',
                'current_quantity',
                'ship_url',
                'updated_at',
                'created_at',
                'id',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'movement' => '0',
                'current_quantity' => '0',
                'ship_url' => 'https://swapi.dev/api/vehicles/16/',
            ],
        ]);
    }
}
