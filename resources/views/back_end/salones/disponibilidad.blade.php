@extends('adminlte::layouts.app_two')
@section('htmlheader_title')
    Reservas Salón
@endsection
@section('contentheader_title')
    Reservas Salón
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
                        <h4 class="box-title">Glosario Colores</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @foreach($data2 as $data2)
                                <button type="button" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $data2->colorSalon }}"><strong>{{ $data2 -> nombreSalon }}</strong>
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
                    <div class="panel-heading"><i class="fa fa-calendar"></i> Calendario de Reservas Salones</div>

                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

