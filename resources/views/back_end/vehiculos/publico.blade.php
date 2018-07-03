@extends('adminlte::layouts.publico')
@section('htmlheader_title')
    Reservas Vehículo
@endsection
@section('contentheader_title')
    Reservas Vehículo
@endsection
@section('contentheader_description')
    / Calendario de Disponibilidad
@endsection
@section('main-content')

    <div class="container">
        <div class="row">

            <div class="col-md-3  no-print">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Reserva de Vehículos</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <center><a href="/"><img src="/img/logo.png" alt=""></a></center>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Glosario Colores</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @foreach($vehi_lista as $vehi_lista)
                                <form action="/Publico/Publico" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="tipo" value="Vehiculo">
                                    <input type="hidden" name="idItem" value="{{ $vehi_lista -> idVehiculo }}">
                                    <button type="submit" class="btn btn-block btn-flat"
                                            style="color: #ffffff; background-color: {{ $vehi_lista->colorVehiculo }}">
                                        <strong>{{ $vehi_lista -> tipoVehiculo }} {{$vehi_lista->patenteVehiculo}}</strong>
                                    </button>
                                </form><br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-truck"></i> Calendario de Reservas Vehículo</div>

                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

