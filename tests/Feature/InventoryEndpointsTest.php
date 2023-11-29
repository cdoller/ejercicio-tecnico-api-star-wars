<?php

namespace Tests\Feature;

use Tests\TestCase;

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

    public function test_inventory_starships_reset_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/reset', [
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
                'ship_url' => 'https://swapi.dev/api/starships/2/',
            ],
        ]);
    }

    public function test_inventory_starships_add_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/add', [
            'id' => 2, 
            'quantity' => 5, 
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
                'movement' => '5',
                'current_quantity' => '5',
                'ship_url' => 'https://swapi.dev/api/starships/2/',
            ],
        ]);

        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/add', [
            'id' => 2, 
            'quantity' => 10, 
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'movement' => '10',
                'current_quantity' => '15',
                'ship_url' => 'https://swapi.dev/api/starships/2/',
            ],
        ]);
    }

    public function test_inventory_starships_subtract_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/subtract', [
            'id' => 2, 
            'quantity' => 13, 
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
                'movement' => '-13',
                'current_quantity' => '2',
                'ship_url' => 'https://swapi.dev/api/starships/2/',
            ],
        ]);

        $response = $this->postJson('http://127.0.0.1:8000/api/v1/starships/quantityInventory/subtract', [
            'id' => 2, 
            'quantity' => 3, 
        ]);

        $response->assertStatus(400);

        $response->assertJsonStructure([
            'error',
        ]);
    }

    public function test_inventory_vehicles_reset_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/reset', [
            'id' => 16, 
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

    public function test_inventory_vehicle_add_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/add', [
            'id' => 16, 
            'quantity' => 100, 
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
                'movement' => '100',
                'current_quantity' => '100',
                'ship_url' => 'https://swapi.dev/api/vehicles/16/',
            ],
        ]);

        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/add', [
            'id' => 16, 
            'quantity' => 400, 
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'movement' => '400',
                'current_quantity' => '500',
                'ship_url' => 'https://swapi.dev/api/vehicles/16/',
            ],
        ]);
    }

    public function test_inventory_vehicles_subtract_quantity_endpoint_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/subtract', [
            'id' => 16, 
            'quantity' => 499, 
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
                'movement' => '-499',
                'current_quantity' => '1',
                'ship_url' => 'https://swapi.dev/api/vehicles/16/',
            ],
        ]);

        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/subtract', [
            'id' => 16, 
            'quantity' => 2, 
        ]);

        $response->assertStatus(400);

        $response->assertJsonStructure([
            'error',
        ]);
    }
}
