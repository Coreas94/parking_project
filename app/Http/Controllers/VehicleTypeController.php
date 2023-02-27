<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleTypeController extends Controller
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
        $type = VehicleType::get();
        return view("admin.list_type_vehicles", compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request);
        $validator = Validator::make($request->all(), [
            'type_vehicle_name' => 'required|unique:vehicle_type,type_vehicle_name'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'El tipo de vehiculo ingresado ya existe');
            return back();
        }

        $vehicle_type = VehicleType::create([
            'type_vehicle_name' => $request->type_vehicle_name,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Tipo de vehiculo agregado correctamente!!');
        return redirect("/list_vehicle_type");
    }
}
