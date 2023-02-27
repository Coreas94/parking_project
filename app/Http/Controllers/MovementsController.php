<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Movements;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class MovementsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveIn(Request $request)
    {
        //Find id_vehicle by plate
        $vehicle_id = Vehicle::where('plate', $request->plate)->get();

        if($vehicle_id->isNotEmpty($vehicle_id)){
            if (Movements::where('id_vehicle', $vehicle_id[0]->id_vehicle)->whereNull('date_out')->exists()) {
                Alert::error('Error', 'Ya existe un registro con esa placa, registre la salida primero!!');
                return back();
            }
            
            $movement = new Movements;
            $movement->id_vehicle = $vehicle_id[0]->id_vehicle;    
            $movement->date_in = Carbon::now();
            $movement->description = $request->description;
            $movement->save();
    
            Alert::success('Success', 'Entrada de vehiculo registrada correctamente!!');
            return back();
        }else {
            Alert::error('Error', 'Placa no encontrada, registre el vehiculo primero!!');
            return back();
        }
    }

    public function saveOut(Request $request)
    {
        //Find id_vehicle by plate
        $vehicle_id = Vehicle::where('plate', $request->plate)->get();

        if($vehicle_id->isNotEmpty($vehicle_id)){
            if (Movements::where('id_vehicle', $vehicle_id[0]->id_vehicle)->whereNull('date_out')->exists()) {
                
                $movement = Movements::where('id_vehicle', $vehicle_id[0]->id_vehicle)->first();
                $movement->date_out = Carbon::now();
                $movement->save();

                $type_vehicle = Vehicle::join('vehicle_type', 'vehicle.vehicle_type_id', '=', 'vehicle_type.id_vehicle_type')
                    ->where('vehicle.id_vehicle', $vehicle_id[0]->id_vehicle)
                    ->get(['vehicle_type.type_vehicle_name']);

                switch ($type_vehicle[0]->type_vehicle_name) {
                    case 'Oficial':
                        Alert::success('Success', 'Salida de vehiculo Oficial registrada correctamente!!');
                        return back();
                        break;
                    case 'Residente':
                        Alert::success('Success', 'Salida de vehiculo Residente registrada correctamente, se acumula el tiempo!!');
                        return back();
                        break;
                    default:
                        $times = Movements::where('id_vehicle', $vehicle_id[0]->id_vehicle)->get();
                        $start_date = Carbon::parse($times[0]->date_in);
                        $end_date = Carbon::parse($times[0]->date_out);
                        $total = $end_date->diffInMinutes($start_date);
                        $total_price = $total * 0.5;

                        Alert::success('Success', 'Salida de vehiculo No Residente registrada correctamente, TOTAL TIEMPO ESTANCIA: '.$total.' minutos, TOTAL A PAGAR: $'.$total_price);
                        return back();
                        break;
                }
            }else {
                Alert::error('Error', 'No existe un registro de entrada del vehiculo!!');
                return back();
            }
        }else {
            Alert::error('Error', 'Placa no encontrada, registre el vehiculo primero!!');
            return back();
        }
    }
}
