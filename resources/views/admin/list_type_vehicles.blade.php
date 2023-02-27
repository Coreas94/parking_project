@extends('layouts.master')
@section('content')
<div class="card">
   <h5 class="card-header">Listado de tipos de vehiculos</h5>
   <div class="table-responsive text-nowrap">
     <table class="table">
       <thead>
         <tr>
           <th>ID</th>
           <th>Tipo de vehiculo</th>
           <th>Fecha de creación</th>
         </tr>
       </thead>
         @if(!empty($type) && $type->count())
            @foreach($type as $data)
               <tr>
                  <td> {{$data->id_vehicle_type}} </td>
                  <td> {{$data->type_vehicle_name}}</td>
                  <td> {{$data->created_at}} </td>
               </tr>
            @endforeach
         @else
            <tr>
               <td></td>
               <td colspan="2">No hay datos sobre tipos de vehiculos.</td>
            </tr>
        @endif
       </tbody>
     </table>
     <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-primary" href="{{url('/add_vehicle_type')}}" type="button">Agregar nuevo</a>
    </div>
   </div>
 </div>
@stop