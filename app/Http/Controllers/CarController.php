<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
Use File;
Use Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        if($request->keyword)
        {
        // search by Plate Number
        $user = auth()->user();
        $cars = $user->cars()->where('plate_number','LIKE','%'.$request->keyword.'%')->paginate(2);
        }

        else
        {
            // query all schedule from 'schedules' table to $schedules
            // select * from schedules - SQL Query
            //$schedules = Schedule::all();
            $user = auth()->user();
            $cars = $user->cars()->paginate(2);
        }
        // query all car from 'cars' table to $cars
        // select * from cars - SQL Query

        // $cars = Car::all();

        // schedules user yg tgah login sahaja
        // function paginate utk show berapa per page

        // $user = auth()->user();
        // $cars = $user->cars()->paginate(5);

        // return to view with $cars
        // resurces/views/cars/index.blade.php
        return view('cars.index', compact('cars'));

    }

    public function create()
    {
        // this is car create form
        // show create form
        // resources/views/cars/create.blade.php
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // store all input to table 'cars' using model Car
        $car = new Car();
        $car->plate_number = $request->plate_number;
        $car->model = $request->model;
        $car->user_id = auth()->user()->id;
        $car->save();

        // add attachment
        if($request->hasFile('attachment'))
        {
            //rename file - ltak id, tarikh ( 5-2021-09-03.jpg/xls)
            $filename = $car->id.'-'.date("y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            //Storage attachment on storage
            Storage::disk('public')->put($filename, File::get($request->attachment));

            // update row
            $car->attachment = $filename;
            $car->save();
        }

        // return to index
        return redirect()
        ->route('car:index')
        ->with([
            'alert-type' => 'alert-primary',
            'alert' => 'Your Car Have Been Saved!'
        ]);

    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Car $car, Request $request)
    {
        // Update $car using input from edit form

        $car->plate_number = $request->plate_number;
        $car->model = $request->model;
        $car->save();

        //redirect to car index
        return redirect()->route('car:index');
    }

    public function destroy (Car $car)
    {
        if($car->attachment)
        {
            Storage::disk('public')->delete($car->attachment);
        }

        // Delete $car from db
        $car->delete();

        // return to car index
        return redirect()
        ->route('car:index')
        ->with([
            'alert-type' => 'alert-danger',
            'alert' => 'Your Car Have Been Deleted!'
        ]);
    }

    public function forceDestroy(Car $car)
{
    $car->forceDelete();

    return redirect()
    ->route('car:index')
    ->with([
        'alert-type' => 'alert-danger',
        'alert' => 'Your Car Have Been Deleted!'
    ]);
}
}
