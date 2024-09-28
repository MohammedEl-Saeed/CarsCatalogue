<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Services\CarServiceInterface;

class CarController extends Controller
{

    protected $carService;

    public function __construct(CarServiceInterface $carService)
    {
        $this->carService = $carService;
    }

    public function index()
    {
        return $this->carService->index();
    }

    public function show($id)
    {
        return $this->carService->show($id);
    }

    public function store(CarRequest $request)
    {
        $car = $this->carService->store($request);
        
        return response()->json($car, 201);
    }

    public function update(CarRequest $request, $id)
    {
       
        $car = $this->carService->update($id, $request);

        return response()->json($car);
    }

    public function destroy($id)
    {
        
        $this->carService->destroy($id);

        return response()->json(null, 204);
    }

}
