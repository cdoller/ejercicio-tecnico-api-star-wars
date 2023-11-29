<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShipEndpointsTest extends TestCase
{
    public function test_ship_get_starships_endpoint_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/starships');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'count',
            'next',
            'previous',
            'results' => [
                '*' => [
                    'name',
                    'model',
                    'manufacturer',
                    'cost_in_credits',
                    'length',
                    'max_atmosphering_speed',
                    'crew',
                    'passengers',
                    'cargo_capacity',
                    'consumables',
                    'hyperdrive_rating',
                    'MGLT',
                    'starship_class',
                    'pilots',
                    'films',
                    'created',
                    'edited',
                    'url',
                    'count',
                ],
            ],
        ]);
    }

    public function test_ship_get_specific_starship_endpoint_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/starships/2');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'name',
            'model',
            'manufacturer',
            'cost_in_credits',
            'length',
            'max_atmosphering_speed',
            'crew',
            'passengers',
            'cargo_capacity',
            'consumables',
            'hyperdrive_rating',
            'MGLT',
            'starship_class',
            'pilots',
            'films',
            'created',
            'edited',
            'url',
            'count',
        ]);
    }

    public function test_ship_get_starships_count_endpoint_id_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/starships/count?id=2');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'name',
            'model',
            'count',
            'url',
        ]);
    }

    public function test_ship_get_starships_count_endpoint_name_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/starships/count?name=star');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'name',
                'model',
                'count',
                'url',
            ]
        ]);
    }

    public function test_ship_get_starships_count_endpoint_fail()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/starships/count');

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'detail',
        ]);
    }

    public function test_ship_get_vehicles_endpoint_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'count',
            'next',
            'previous',
            'results' => [
                '*' => [
                    'name',
                    'model',
                    'manufacturer',
                    'cost_in_credits',
                    'length',
                    'max_atmosphering_speed',
                    'crew',
                    'passengers',
                    'cargo_capacity',
                    'consumables',
                    'vehicle_class',
                    'pilots',
                    'films',
                    'created',
                    'edited',
                    'url',
                    'count',
                ],
            ],
        ]);
    }

    public function test_ship_get_specific_vehicle_endpoint_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/16');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'name',
            'model',
            'manufacturer',
            'cost_in_credits',
            'length',
            'max_atmosphering_speed',
            'crew',
            'passengers',
            'cargo_capacity',
            'consumables',
            'vehicle_class',
            'pilots',
            'films',
            'created',
            'edited',
            'url',
            'count',
        ]);
    }

    public function test_ship_get_vehicles_count_endpoint_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/count?id=16');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'name',
            'model',
            'count',
            'url',
        ]);
    }

    public function test_ship_get_vehicles_count_endpoint_name_success()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/count?name=ship');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'name',
                'model',
                'count',
                'url',
            ]
        ]);
    }

    public function test_ship_get_vehicles_count_endpoint_fail()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/count');

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'detail',
        ]);
    }

    public function test_ship_get_vehicle_count_after_operations_success()
    {
        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/reset', [
            'id' => 16, 
            'quantity' => 0, 
        ]);

        $response->assertStatus(201);

        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/count?id=16');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'name',
            'model',
            'count',
            'url',
        ]);

        $response->assertJson([
            'name' => 'TIE bomber',
            "model" => "TIE/sa bomber",
            "count"=> 0,
            "url" => "https://swapi.dev/api/vehicles/16/",
        ]);

        $response = $this->postJson('http://127.0.0.1:8000/api/v1/vehicles/quantityInventory/add', [
            'id' => 16, 
            'quantity' => 10, 
        ]);

        $response->assertStatus(201);

        $response = $this->getJson('http://127.0.0.1:8000/api/v1/vehicles/count?id=16');

        $response->assertJson([
            'name' => 'TIE bomber',
            "model" => "TIE/sa bomber",
            "count"=> 10,
            "url" => "https://swapi.dev/api/vehicles/16/",
        ]);
    }

    
}
