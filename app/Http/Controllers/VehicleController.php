<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicle::join('vehicle_type', 'vehicle.vehicle_type_id', '=', 'vehicle_type.id_vehicle_type')->get();
        return view("admin.list_vehicles", compact('vehicle'));
    }
    
    public function addVehicleView()
    {
        $type = VehicleType::get();
        return view("admin.vehicle", compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = VehicleType::get();
        $validator = Validator::make($request->all(), [
            'plate' => 'required|unique:vehicle,plate',
            'vehicle_type' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'La placa ingresada ya existe');
            return back();
        }

        $vehicle_type = Vehicle::create([
            'plate' => $request->plate,
            'vehicle_type_id' => $request->vehicle_type,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Vehiculo agregado correctamente!!');
        return redirect("/list_vehicle");
    }
}
