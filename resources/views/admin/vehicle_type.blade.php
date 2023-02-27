@extends('layouts.master')
@section('content')
   <div class="row">
      <div class="col-xl">
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Registrar tipos de vehiculo</h5>
            </div>
            <div class="card-body">
               <form method="post" action="{{url('create_type_vehicle')}}">
                  @csrf
                  <div class="mb-3">
                     <label class="form-label" for="type_vehicle_name">Tipo de vehiculo</label>
                     <input type="text" class="form-control" id="type_vehicle_name" name="type_vehicle_name" placeholder="Residente" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="basic-default-message">Comentario</label>
                     <textarea id="description" name="description" class="form-control" placeholder="Informacion"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Send</button>
               </form>
            </div>
         </div>
      </div>
   </div>
@stop