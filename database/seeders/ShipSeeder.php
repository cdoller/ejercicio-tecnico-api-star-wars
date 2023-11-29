<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Seeder;
use App\Http\Controllers\ShipController;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipController = new ShipController();
        $ships = $shipController->getAllShipsFromSwapi('starships');

        foreach ($ships as $ship){
            Ship::create([
                'url' => $ship->url,
                'ship_type' => 'Starship',
            ]);
        } 

        $ships = $shipController->getAllShipsFromSwapi('vehicles');

        foreach ($ships as $ship){
            Ship::create([
                'url' => $ship->url,
                'ship_type' => 'Vehicle',
            ]);
        } 
    }
}
