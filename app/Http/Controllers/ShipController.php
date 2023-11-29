<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Ship\GetCountRequest;
use App\Http\Requests\Ship\GetShipsRequest;
use App\Http\Controllers\InventoryController;

/**
    * @OA\Info(
    *             title="API StarWars extendida", 
    *             version="1.0",
    *             description="Listado de la URI's de la API Naves"
    * )
    *
    * @OA\Server(url="http://127.0.0.1:8000")
*/

class ShipController extends Controller
{
    /////////////////////////////////////////////////
    ////////// METHODS PUBLICS FROM ROUTES //////////
    /////////////////////////////////////////////////

    /**
     * Returns the Vehicles with the added 'count' property. Returns them in a paginated manner.
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/vehicles",
     *     tags={"Vehicles"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by name or model",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Number of page for results in pagination",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="count", type="integer", description="Total quantity of vehicles", example="30"),
     *             @OA\Property(property="next", type="string", description="Next url page", example="https://swapi.dev/api/vehicles/?page=2"),
     *             @OA\Property(property="previous", type="string", description="Previous url page", example="https://swapi.dev/api/vehicles/?page=1"),
     *             @OA\Property(
     *                 property="results",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="name", type="string", description="The name of this vehicle. The common name, such as Sand Crawler or Speeder bike"),
     *                     @OA\Property(property="model", type="string", description="The model or official name of this vehicle. Such as All-Terrain Attack Transport"),
     *                     @OA\Property(property="vehicle_class", type="string", description="The class of this vehicle, such as Wheeled or Repulsorcraft"),
     *                     @OA\Property(property="manufacturer", type="string", description="The manufacturer of this vehicle. Comma separated if more than one"),
     *                     @OA\Property(property="length", type="string", description="The length of this vehicle in meters"),
     *                     @OA\Property(property="cost_in_credits", type="string", description="The cost of this vehicle new, in Galactic Credits"),
     *                     @OA\Property(property="crew", type="string", description="The number of personnel needed to run or pilot this vehicle"),
     *                     @OA\Property(property="passengers", type="string", description="The number of non-essential people this vehicle can transport"),
     *                     @OA\Property(property="max_atmosphering_speed", type="string", description="The maximum speed of this vehicle in the atmosphere"),
     *                     @OA\Property(property="cargo_capacity", type="string", description="The maximum number of kilograms that this vehicle can transport"),
     *                     @OA\Property(property="consumables", type="string", description="The maximum length of time that this vehicle can provide consumables for its entire crew without having to resupply"),
     *                     @OA\Property(
     *                          property="films",
     *                          type="array",
     *                          description="An array of Film URL Resources that this vehicle has appeared in",
     *                          @OA\Items(type="string", description="Films URLs Resources")
     *                     ),
     *                     @OA\Property(
     *                          property="pilots",
     *                          type="array",
     *                          description="An array of People URL Resources that this vehicle has been piloted by",
     *                          @OA\Items(type="string", description="People URLs Resources")
     *                     ),
     *                     @OA\Property(property="url", type="string", description="the hypermedia URL of this resource"),
     *                     @OA\Property(property="created", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *                     @OA\Property(property="edited", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *                     @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for request params", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getVehicles(GetShipsRequest $request)
    {
        $resource = 'vehicles';
        return $this->getShips($request, $resource);
    }

    /**
     * Returns the Starships with the added 'count' property. Returns them in a paginated manner.
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/starships",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by name or model",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Number of page for results in pagination",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="count", type="integer", description="Total Quantity of Starships", example="30"),
     *             @OA\Property(property="next", type="string", description="Next page url", example="https://swapi.dev/api/vehicles/?page=2"),
     *             @OA\Property(property="previous", type="string", description="Previous page url", example="https://swapi.dev/api/vehicles/?page=1"),
     *             @OA\Property(
     *                 property="results",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="name", type="string", description="The name of this starship. The common name, such as Death Star"),
     *                     @OA\Property(property="model", type="string", description="The model or official name of this starship. Such as T-65 X-wing or DS-1 Orbital Battle Station"),
     *                     @OA\Property(property="starship_class", type="string", description="The class of this starship, such as Starfighter or Deep Space Mobile Battlestation"),
     *                     @OA\Property(property="manufacturer", type="string", description="The manufacturer of this starship. Comma separated if more than one"),
     *                     @OA\Property(property="cost_in_credits", type="string", description="The cost of this starship new, in galactic credits"),
     *                     @OA\Property(property="length", type="string", description="The length of this starship in meters"),
     *                     @OA\Property(property="crew", type="string", description="The number of personnel needed to run or pilot this starship"),
     *                     @OA\Property(property="passengers", type="string", description="The number of non-essential people this starship can transport"),
     *                     @OA\Property(property="max_atmosphering_speed", type="string", description="The maximum speed of this starship in the atmosphere. N/A if this starship is incapable of atmospheric flight"),
     *                     @OA\Property(property="hyperdrive_rating", type="string", description="The class of this starships hyperdrive"),
     *                     @OA\Property(property="MGLT", type="string", description="The Maximum number of Megalights this starship can travel in a standard hour. A Megalight is a standard unit of distance and has never been defined before within the Star Wars universe. This figure is only really useful for measuring the difference in speed of starships. We can assume it is similar to AU, the distance between our Sun (Sol) and Earth"),
     *                     @OA\Property(property="cargo_capacity", type="string", description="The maximum number of kilograms that this starship can transport"),
     *                     @OA\Property(property="consumables", type="string", description="The maximum length of time that this starship can provide consumables for its entire crew without having to resupply"),
     *                     @OA\Property(
     *                          property="films",
     *                          type="array",
     *                          description="An array of Film URL Resources that this vehicle has appeared in",
     *                          @OA\Items(type="string", description="Films URLs Resources")
     *                     ),
     *                     @OA\Property(
     *                          property="pilots",
     *                          type="array",
     *                          description="An array of People URL Resources that this vehicle has been piloted by",
     *                          @OA\Items(type="string", description="People URLs Resources")
     *                     ),
     *                     @OA\Property(property="url", type="string", description="the hypermedia URL of this resource"),
     *                     @OA\Property(property="created", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *                     @OA\Property(property="edited", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *                     @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not matches results for request params", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getStarships(GetShipsRequest $request)
    {
        $resource = 'starships';
        return $this->getShips($request, $resource);
    }

    /**
     * Returns a specific Vehicle using his ID, with the added 'count' property.
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/vehicles/{id}",
     *     tags={"Vehicles"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", description="The name of this vehicle. The common name, such as Sand Crawler or Speeder bike"),
     *             @OA\Property(property="model", type="string", description="The model or official name of this vehicle. Such as All-Terrain Attack Transport"),
     *             @OA\Property(property="vehicle_class", type="string", description="The class of this vehicle, such as Wheeled or Repulsorcraft"),
     *             @OA\Property(property="manufacturer", type="string", description="The manufacturer of this vehicle. Comma separated if more than one"),
     *             @OA\Property(property="length", type="string", description="The length of this vehicle in meters"),
     *             @OA\Property(property="cost_in_credits", type="string", description="The cost of this vehicle new, in Galactic Credits"),
     *             @OA\Property(property="crew", type="string", description="The number of personnel needed to run or pilot this vehicle"),
     *             @OA\Property(property="passengers", type="string", description="The number of non-essential people this vehicle can transport"),
     *             @OA\Property(property="max_atmosphering_speed", type="string", description="The maximum speed of this vehicle in the atmosphere"),
     *             @OA\Property(property="cargo_capacity", type="string", description="The maximum number of kilograms that this vehicle can transport"),
     *             @OA\Property(property="consumables", type="string", description="The maximum length of time that this vehicle can provide consumables for its entire crew without having to resupply"),
     *             @OA\Property(
     *                  property="films",
     *                  type="array",
     *                  description="An array of Film URL Resources that this vehicle has appeared in",
     *                  @OA\Items(type="string", description="Films URLs Resources")
     *             ),
     *             @OA\Property(
     *                  property="pilots",
     *                  type="array",
     *                  description="An array of People URL Resources that this vehicle has been piloted by",
     *                  @OA\Items(type="string", description="People URLs Resources")
     *             ),
     *             @OA\Property(property="url", type="string", description="the hypermedia URL of this resource"),
     *             @OA\Property(property="created", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="edited", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not match result for {id}", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getSpecificVehicle($id)
    {
        if (! $this->validateId($id)) {
            return response()->json([
                'detail' => 'The ID must be a number greater than 0'
            ]);
        }
        $resource = 'vehicles';
        return $this->getSpecificShip($id, $resource);
    }

    /**
     * Returns a specific Starship using his ID, with the added 'count' property.
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/starships/{id}",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", description="The name of this starship. The common name, such as Death Star"),
     *             @OA\Property(property="model", type="string", description="The model or official name of this starship. Such as T-65 X-wing or DS-1 Orbital Battle Station"),
     *             @OA\Property(property="starship_class", type="string", description="The class of this starship, such as Starfighter or Deep Space Mobile Battlestation"),
     *             @OA\Property(property="manufacturer", type="string", description="The manufacturer of this starship. Comma separated if more than one"),
     *             @OA\Property(property="cost_in_credits", type="string", description="The cost of this starship new, in galactic credits"),
     *             @OA\Property(property="length", type="string", description="The length of this starship in meters"),
     *             @OA\Property(property="crew", type="string", description="The number of personnel needed to run or pilot this starship"),
     *             @OA\Property(property="passengers", type="string", description="The number of non-essential people this starship can transport"),
     *             @OA\Property(property="max_atmosphering_speed", type="string", description="The maximum speed of this starship in the atmosphere. N/A if this starship is incapable of atmospheric flight"),
     *             @OA\Property(property="hyperdrive_rating", type="string", description="The class of this starships hyperdrive"),
     *             @OA\Property(property="MGLT", type="string", description="The Maximum number of Megalights this starship can travel in a standard hour. A Megalight is a standard unit of distance and has never been defined before within the Star Wars universe. This figure is only really useful for measuring the difference in speed of starships. We can assume it is similar to AU, the distance between our Sun (Sol) and Earth"),
     *             @OA\Property(property="cargo_capacity", type="string", description="The maximum number of kilograms that this starship can transport"),
     *             @OA\Property(property="consumables", type="string", description="The maximum length of time that this starship can provide consumables for its entire crew without having to resupply"),
     *             @OA\Property(
     *                  property="films",
     *                  type="array",
     *                  description="An array of Film URL Resources that this vehicle has appeared in",
     *                  @OA\Items(type="string", description="Films URLs Resources")
     *             ),
     *             @OA\Property(
     *                  property="pilots",
     *                  type="array",
     *                  description="An array of People URL Resources that this vehicle has been piloted by",
     *                  @OA\Items(type="string", description="People URLs Resources")
     *             ),
     *             @OA\Property(property="url", type="string", description="the hypermedia URL of this resource"),
     *             @OA\Property(property="created", type="string", description="the ISO 8601 date format of the time that this resource was created"),
     *             @OA\Property(property="edited", type="string", description="the ISO 8601 date format of the time that this resource was edited"),
     *             @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not match result for {id}", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getSpecificStarship($id)
    {
        if (! $this->validateId($id)) {
            return response()->json([
                'detail' => 'The ID must be a number greater than 0'
            ]);
        }
        $resource = 'starships';
        return $this->getSpecificShip($id, $resource);
    }

    /**
     * Returns a count of specific Vehicle using his ID or name or model.
     * A Vehicle resource is a single transport craft that does not have hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/vehicles/count",
     *     tags={"Vehicles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Search by id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="name of vehicle",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="model",
     *         in="query",
     *         description="model of vehicle",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", description="The name of this vehicle."),
     *             @OA\Property(property="model", type="string", description="The model or official name of this vehicle."),
     *             @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle"),
     *             @OA\Property(property="url", type="string", description="the hypermedia URL of this resource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not match result for {id}", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getSpecificVehicleCount(GetCountRequest $request)
    {
        $resource = 'vehicles';
        return $this->getSpecificShipCount($request, $resource);
    }

    /**
     * Returns a count of specific Starship using his ID or name or model.
     * A Starship resource is a single transport craft that has hyperdrive capability.
     * @OA\Get (
     *     path="/api/v1/starships/count",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Search by id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="name of starship",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="model",
     *         in="query",
     *         description="model of starship",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", description="The name of this starship. The common name, such as Death Star"),
     *             @OA\Property(property="model", type="string", description="The model or official name of this starship. Such as T-65 X-wing or DS-1 Orbital Battle Station"),
     *             @OA\Property(property="count", type="integer", description="Specific quantity of this vehicle"),
     *             @OA\Property(property="url", type="string", description="the hypermedia URL of this resource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="detail", type="string", description="Not match result for {id}", example="Not found"),
     *         )
     *     )
     * )
     */
    public function getSpecificStarshipCount(GetCountRequest $request)
    {
        $resource = 'starships';
        return $this->getSpecificShipCount($request, $resource);
    }

    /////////////////////////////////////////////////
    ///////////////// OTHER METHODS /////////////////
    /////////////////////////////////////////////////

    /**
     * Obtains an array with all ships.
     * 
     * @param resource resource from Swapi
     * @return array array with all occurrences from resource
     */
    public function getAllShipsFromSwapi($resource)
    {
        try{
            $url = 'https://swapi.dev/api/' . $resource;
            $allShips = [];

            do{
                $response = Http::get($url);
                foreach($response->object()->results as $transport){
                    array_push($allShips, $transport);
                }
                $url = $response->object()->next;
            }
            while($response->object()->next != null);            

        }catch(Exception $e){
            echo "Error connection with Swapi";
        }

        return $allShips;
    }

    /**
     * Obtains the list of ships with full data, the results are paginate. Also you can search by name or model.
     * 
     * @param \App\Http\Requests\GetCountRequest
     * @param resource name of resource
     * @return \Illuminate\Http\Response
     */
    public function getShips(GetShipsRequest $request, $resource)
    {
        try{
            $url = "https://swapi.dev/api/$resource";
            $response = Http::get($url, [
                'page' => $request['page'],
                'search' => $request['search'],
            ]);
            
            $data = $response->json();

            foreach ($data['results'] as &$result) {
                $result['count'] = InventoryController::getCurrentQuantity($result['url']);
            }

            return response()->json($data, $response->status());

        }catch(Exception $e){
            if (isset($response)) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json(['error' => 'Not Found'], Response::HTTP_NOT_FOUND);
            }
        }
    }

    /**
     * Obtains the full data of a ship, you can search by ID.
     * 
     * @param id specific id of a ship
     * @param resource name of resource
     * @return \Illuminate\Http\Response
     */
    public function getSpecificShip($id, $resource)
    {
        try{
            $url = "https://swapi.dev/api/$resource/$id/";
            $response = Http::get($url);

            $data = $response->json();
            if($response->successful()){
                $data['count'] = InventoryController::getCurrentQuantity($url);
            }

            return response()->json($data, $response->status());
        }catch(Exception $e){
            if (isset($response)) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
            }
        }
    }

    /**
     * Obtains the basic data of a ship, you can search by ID, model or name.
     * 
     * @param \App\Http\Requests\GetCountRequest
     * @param resource name of resource
     * @return \Illuminate\Http\Response
     */
    public function getSpecificShipCount(GetCountRequest $request, $resource)
    {
        try{
            if( !isset($request['id']) && !isset($request['name']) && !isset($request['model'])){
                throw new Exception('Must be insert an id, name or model');
            }

            if (isset($request['id'])){

                $specificStarShip = $this->getSpecificShip($request['id'], $resource);
                if($specificStarShip->getStatusCode() == 404){
                    throw new Exception('Not found');
                }

                $specificStarShipData = $specificStarShip->getData(true);
                if (is_null($specificStarShipData)) {
                    throw new Exception('Dont have information');
                }
            
                return response()->json([
                    'name'  => $specificStarShipData['name'],
                    'model' => $specificStarShipData['model'],
                    'count' => $specificStarShipData['count'],
                    'url' => $specificStarShipData['url'],
                ], 200);
            }

            if($request->has('name') || $request->has('model')){

                $searchParameter = $request->has('name') ? 'name' : 'model';

                $request->merge([
                    'search' => $request->input($searchParameter),
                ]);

                $newRequest = new GetShipsRequest(['search' => $request['search']]);
                $specificStarShip = $this->getShips($newRequest, $resource);

                $formattedResults = [];

                foreach ($specificStarShip->getData()->results as $result){

                    $formattedResult = [
                        'name' => $result->name,
                        'model' => $result->model,
                        'count' => $result->count,
                    ];

                    $formattedResults[] = $formattedResult;
                }

                return response()->json($formattedResults, 200);
            }


        }catch(Exception $e){
            return response()->json([
                'detail' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Validate id, id must be numeric and positive
     * 
     * @param id
     * @return boolean true: validate, false: dont validate
     */
    private function validateId($id)
    {
        return (is_numeric($id) && $id > 0);
    }
}
