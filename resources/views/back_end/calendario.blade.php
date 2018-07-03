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
                        <h4 class="box-title">Reserva de {{ $tipo }}</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @if($tipo=='Hardware')
                                <center><a href="/Publico/Hardwares"><img src="/img/logo.png" alt=""></a></center>
                            @elseif($tipo=='Salon')
                                <center><a href="/Publico/Salones"><img src="/img/logo.png" alt=""></a></center>
                            @elseif($tipo=='Vehiculo')
                                <center><a href="/Publico/Vehiculos"><img src="/img/logo.png" alt=""></a></center>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ $tipo }}</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @if($tipo=='Hardware')
                                <button type="submit" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $dato->colorHardware }}"
                                        readonly="">
                                    <strong>{{ $dato -> nombreHardware }}
                                        - {{ $dato -> marcaHardware }} {{ $dato -> modeloHardware }}</strong>
                                </button>
                            @elseif($tipo=='Salon')
                                <button type="submit" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $dato->colorSalon }}"
                                        readonly="">
                                    <strong>{{ $dato -> nombreSalon }}</strong>
                                </button>
                            @elseif($tipo=='Vehiculo')
                                <button type="submit" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $dato->colorVehiculo }}"
                                        readonly="">
                                    <strong>{{ $dato -> tipoVehiculo }} {{$dato->patenteVehiculo}}</strong>
                                </button>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-calendar"></i> Calendario de Reservas {{ $tipo }}</div>

                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

