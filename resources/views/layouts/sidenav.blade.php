<div id="layoutSidenav_nav">
   <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
       <div class="sb-sidenav-menu">
           <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-parking"></i></div>
                    Parqueo
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/vehicle_entrance')}}">Entrada de vehiculo</a>
                        <a class="nav-link" href="{{url('/vehicle_exit')}}">Salida de vehiculo</a>
                    </nav>
                </div>
                
                <a class="nav-link" href="{{url('/list_vehicle')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-car"></i></div>
                    Vehiculos
                </a>
                <a class="nav-link" href="{{url('/list_vehicle_type')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tipo de vehiculo
                </a>
                <a class="nav-link" href="{{url('/resident_payment')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                    Pago de residentes
                </a>

                <a class="nav-link" href="{{url('/init_month')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-refresh"></i></div>
                    Comenzar mes
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
           <div class="small">Logged in as:</div>
            @if(Auth::check())
                <h3>{{ Auth::user()->name}}</h3>
            @endif
        </div>
    </nav>
</div>