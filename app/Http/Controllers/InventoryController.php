<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ship;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Requests\Inventory\IdRequest;
use App\Http\Requests\Inventory\InventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    // public function show(Inventario $inventario)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    // public function edit(Inventario $inventario)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Inventario $inventario)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Inventario $inventario)
    // {
    //     //
    // }


    /////////////////////////////////////////////////
    ////////// METHODS PUBLICS FROM ROUTES //////////
    /////////////////////////////////////////////////

    /**
     * Set an inventory quantity of a specific starship. 
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/starships/quantityInventory/set",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific starship",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/starships/2/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function starshipSetQuantity(InventoryRequest $request)
    {
        $resource = 'starships';
        return $this->setActualQuantity($request, $resource);
    }

    /**
     * Set an inventory quantity of a specific vehicle. 
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/vehicles/quantityInventory/set",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function vehicleSetQuantity(InventoryRequest $request)
    {
        $resource = 'vehicles';
        return $this->setActualQuantity($request, $resource);
    }

    /**
     * Add a quantity of a specific vehicle. 
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/vehicles/quantityInventory/add",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function vehicleAddQuantity(InventoryRequest $request)
    {
        $resource = 'vehicles';
        return $this->addActualQuantity($request, $resource);
    }

    /**
     * Add a quantity of a specific Starship. 
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/starships/quantityInventory/add",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function starshipAddQuantity(InventoryRequest $request)
    {
        $resource = 'starships';
        return $this->addActualQuantity($request, $resource);
    }

    /**
     * Subtract a quantity of a specific vehicle. 
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/vehicles/quantityInventory/subtract",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Operation not allowed: negative stock result")
     *         )
     *     )
     * )
     */
    public function vechicleSubtractQuantity(InventoryRequest $request)
    {
        $resource = 'vehicles';
        return $this->subtractActualQuantity($request, $resource);
    }

    /**
     * Subtract a quantity of a specific Starship. 
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/starships/quantityInventory/subtract",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         required=true,
     *         description="Quantity to set on inventary",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="20"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="20"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Operation not allowed: negative stock result")
     *         )
     *     )
     * )
     */
    public function starshipSubtractQuantity(InventoryRequest $request)
    {
        $resource = 'starships';
        return $this->subtractActualQuantity($request, $resource);
    }

    /**
     * Reset quantity to 0 of a specific Starship. 
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/starships/quantityInventory/reset",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="0"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="0"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/starships/2/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function starshipResetQuantity(IdRequest $request)
    {
        $resource = 'starships';
        return $this->resetQuantity($request, $resource);
    }

    /**
     * Reset quantity to 0 of a specific Vehicle. 
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Post (
     *     path="/api/v1/vehicles/quantityInventory/reset",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="The ID of a specific vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="movement", type="integer", description="Movement actual", example="0"),
     *             @OA\Property(property="current_quantity", type="integer", description="Current quantity that was just set", example="0"),
     *             @OA\Property(property="ship_url", type="string", description="Unique URL from Ship", example="https://swapi.dev/api/vehicles/16/"),
     *             @OA\Property(property="updated_at", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="created_at", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="id", type="integer", description="intern id that represents an unique register")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for id request param", example="Not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Message that explain the error in request", example="Error in validation of parameters"),
     *             @OA\Property(property="errors", type="object", description="List of errors")
     *         )
     *     )
     * )
     */
    public function vehicleResetQuantity(IdRequest $request)
    {
        $resource = 'vehicles';
        return $this->resetQuantity($request, $resource);
    }

    /////////////////////////////////////////////////
    ///////////////// OTHER METHODS /////////////////
    /////////////////////////////////////////////////

    public function setActualQuantity(InventoryRequest $request, $resource)
    {
        try{
            $shipController = new ShipController();

            $response = $shipController->getSpecificShip($request['id'], $resource);
            if($response->status() == 404){
                throw new Exception('Not found');
            }

            $url = $response->getData()->url;
            $ship = Ship::where('url', $url)->first();
            if(!isset($ship)){
                return response()->json([
                    'detail' => 'Starship not found'
                ],404);
            }
            
            $newInventory = $this->createInventory($request['quantity'], $request['quantity'], $url);

            return response()->json([
                'data' => $newInventory
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'detail' => 'Not found',
            ], 404);
        }
    }

    public function addActualQuantity(InventoryRequest $request, $resource)
    {
        try{
            $shipController = new ShipController();

            $response = $shipController->getSpecificShip($request['id'], $resource);
            if($response->status() == 404){
                throw new Exception('Not found');
            }

            $url = $response->getData()->url;
            $ship = Ship::where('url', $url)->first();
            if(!isset($ship)){
                return response()->json([
                    'detail' => 'Starship not found'
                ],404);
            }
            
            $currentQuantity = $request['quantity'] + InventoryController::getCurrentQuantity($url);
            $newInventory = $this->createInventory($request['quantity'], $currentQuantity, $url);

            return response()->json([
                'data' => $newInventory
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'detail' => 'Not found',
            ], 404);
        }
    }

    public function subtractActualQuantity(InventoryRequest $request, $resource)
    {
        try{
            $shipController = new ShipController();

            $response = $shipController->getSpecificShip($request['id'], $resource);
            if($response->status() == 404){
                throw new Exception('Not found');
            }

            $url = $response->getData()->url;
            $ship = Ship::where('url', $url)->first();
            if(!isset($ship)){
                return response()->json([
                    'detail' => 'Starship not found'
                ],404);
            }
            
            $subtotal = InventoryController::getCurrentQuantity($url) - $request['quantity'];
            if($subtotal < 0){
                return response()->json([
                    'error' => 'Operation not allowed: negative stock result'
                ], 400);
            }

            $newInventory = $this->createInventory(-$request['quantity'], $subtotal, $url);

            return response()->json([
                'data' => $newInventory
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'detail' => 'Not found',
            ], 404);
        }
    }

    public function resetQuantity(IdRequest $request, $resource)
    {
        try{
            $shipController = new ShipController();

            $response = $shipController->getSpecificShip($request['id'], $resource);
            if($response->status() == 404){
                throw new Exception('Not found');
            }

            $url = $response->getData()->url;
            $ship = Ship::where('url', $url)->first();
            if(!isset($ship)){
                return response()->json([
                    'detail' => 'Starship not found'
                ],404);
            }
            
            $newInventory = $this->createInventory(0, 0, $url);

            return response()->json([
                'data' => $newInventory
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'detail' => 'Not found',
            ], 404);
        }
    }

    private function createInventory($movement, $quantity, $url)
    {
        return Inventory::create([
            'movement' => $movement,
            'current_quantity' => $quantity,
            'ship_url' => $url,
        ]);
    }

    public static function getCurrentQuantity($url)
    {
        return Inventory::where('ship_url', $url)->latest()->value('current_quantity') ?? 0;
    }
}
