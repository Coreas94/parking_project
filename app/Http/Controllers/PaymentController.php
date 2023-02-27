<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Movements;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\ExportPaymentData;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
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
        $movements = Movements::join('vehicle', 'movements.id_vehicle', '=', 'vehicle.id_vehicle')
            ->join('vehicle_type', 'vehicle.vehicle_type_id', '=', 'vehicle_type.id_vehicle_type')
            ->where('movements.status', 0)
            ->where('vehicle_type.type_vehicle_name', 'Residente')
            ->get(['movements.date_in', 'movements.date_out', 'vehicle.plate']);

        

        foreach ($movements as $key => $value) {
            $start_date = Carbon::parse($value->date_in);
            $end_date = Carbon::parse($value->date_out);
            $total = $end_date->diffInMinutes($start_date);
            $total_price = $total * 0.05;
            $movements[$key]['total_time'] = $total;
            $movements[$key]['total_price'] = number_format($total_price, 2);
        }

        return view('admin.payment', compact('movements'));
    }

    public function initMonth(){
        $movement = Movements::where('status', 0)
        ->update(['status' => 1, 'date_out' => Carbon::now()]);

        Alert::success('Success', 'Se reinició el contador de tiempo correctamente!!');
        return back();
    }

    public function exportData(Request $request){
        $movements = Movements::join('vehicle', 'movements.id_vehicle', '=', 'vehicle.id_vehicle')
            ->join('vehicle_type', 'vehicle.vehicle_type_id', '=', 'vehicle_type.id_vehicle_type')
            ->where('movements.status', 0)
            ->where('vehicle_type.type_vehicle_name', 'Residente')
            ->get(['vehicle.plate', 'movements.date_in', 'movements.date_out', ]);

        

        foreach ($movements as $key => $value) {
            $start_date = Carbon::parse($value->date_in);
            $end_date = Carbon::parse($value->date_out);
            $total = $end_date->diffInMinutes($start_date);
            $total_price = $total * 0.05;
            $movements[$key]['total_time'] = $total;
            $movements[$key]['total_price'] = number_format($total_price, 2);

            $result[$key]['placa'] = $value->plate;
            $result[$key]['total_time'] = $total;
            $result[$key]['total_price'] = number_format($total_price, 2);
        }
        
        $date = Carbon::now();
        $monthName = $date->format('F');
        return Excel::download(new ExportPaymentData($result), 'payment_'.$monthName.'.xlsx');
    }
}
