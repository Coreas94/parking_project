@extends('layouts.master')
@section('content')
   <div class="row">
      <div class="col-xl">
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Registrar entrada de vehiculo</h5>
            </div>
            <div class="card-body">
               <form method="post" action="{{url('create_vehicle_entrance')}}">
                  @csrf
                  <div class="mb-3">
                     <label class="form-label" for="plate">Placa de vehiculo</label>
                     <input type="text" class="form-control" id="plate" name="plate" placeholder="P123456" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="basic-default-message">Comentario</label>
                     <textarea id="description" name="description" class="form-control" placeholder="Residente del edificio 20"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Send</button>
               </form>
            </div>
         </div>
      </div>
   </div>
@stop