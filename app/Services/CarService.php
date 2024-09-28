<?php

// app/Services/CarService.php

namespace App\Services;

use App\Models\Car;
use Auth;
use Storage;

class CarService implements CarServiceInterface
{
    
    public function index()
    {
       return Car::with('user')->paginate(10);
    }

    public function show($id)
    {
        return Car::findOrFail($id);
    }

    public function store($request)
    {
        $data = $request->except('image');

        $data['user_id'] = Auth::id();

        $car = new Car($data);

        $car = $this->handleUploadImage($request, $car);

        $car->save();

        return $car;
    }

    public function update($id, $request)
    {
        $car = Car::findOrFail($id);
       
        $car->fill($request->except('image'));

        $car = $this->handleUploadImage($request, $car);

        $car->save();

        return $car;
    }

    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
    }

    private function handleUploadImage($request, $car){

        if ($request->hasFile('image')) {

            // Delete old image if it exists
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }

            $car->image = $request->file('image')->store('images', 'public');
        }
        return $car;
    }
}
