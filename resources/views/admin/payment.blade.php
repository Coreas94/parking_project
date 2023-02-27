@extends('layouts.master')
@section('content')
<div class="card">
   <h5 class="card-header">Pago de residentes</h5>
   <div class="table-responsive text-nowrap">
     <table class="table">
       <thead>
         <tr>
           <th>Numero de placa</th>
           <th>Tiempo estacionado (min)</th>
           <th>Total a pagar</th>
         </tr>
       </thead>
         @if(!empty($movements) && $movements->count())
            @foreach($movements as $data)
               <tr>
                  <td> {{$data->plate}} </td>
                  <td> {{$data->total_time}} Minutos</td>
                  <td> ${{$data->total_price}} </td>
               </tr>
            @endforeach
         @else
            <tr>
               <td></td>
               <td colspan="2">No hay datos del mes actual.</td>
            </tr>
        @endif
       </tbody>
      </table>
      @if(!empty($movements) && $movements->count())
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary" href="{{url('/export_data')}}" type="button">Exportar a archivo</a>
      </div>
    @endif
   </div>
 </div>
@stop