@extends('adminlte::layouts.app_two')
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

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-3  no-print">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Glosario Colores</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @foreach($vehi_lista as $vehi_lista)
                                <button type="button" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $vehi_lista->colorVehiculo }}">
                                    <strong>{{ $vehi_lista -> tipoVehiculo }} {{$vehi_lista->patenteVehiculo}}</strong>
                                </button>
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

