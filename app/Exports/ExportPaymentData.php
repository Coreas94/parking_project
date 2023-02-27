<?php

namespace App\Exports;

use App\Models\Movements;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPaymentData implements FromCollection, WithHeadings
{

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return ["Placa", "Tiempo estacionado (mins)", "Total a pagar"];
    }
}
