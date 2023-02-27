@extends('layouts.master')
@section('content')
   <div class="row">
      <div class="col-xl">
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Dar de alta nuevo vehiculo</h5>
            </div>
            <div class="card-body">
               <form method="post" action="{{url('create_vehicle')}}">
                  @csrf
                  <div class="mb-3">
                     <label class="form-label" for="plate">Placa</label>
                     <input type="text" class="form-control" id="plate" name="plate" placeholder="P425135" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="vehicle_type">Tipo de vehiculo</label>
                        <select class="form-select" id="vehicle_type" name="vehicle_type" aria-label="Default select example">
                           @foreach($type as $row)
                           <option value="{{ $row->id_vehicle_type }}">{{ $row->type_vehicle_name}}</option>
                        @endforeach 
                        </select>
                     </div>
                  <button type="submit" class="btn btn-primary">Send</button>
               </form>
            </div>
         </div>
      </div>
   </div>
@stop