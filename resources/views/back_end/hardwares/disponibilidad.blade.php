@extends('adminlte::layouts.app_two')
@section('htmlheader_title')
    Reservas Hardware
@endsection
@section('contentheader_title')
    Reservas Hardware
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
                            @foreach($hard_lista as $hard_lista)
                                <button type="button" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $hard_lista->colorHardware }}">
                                    <strong>{{ $hard_lista -> nombreHardware }}
                                        - {{ $hard_lista -> marcaHardware }} {{ $hard_lista -> modeloHardware }}</strong>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Solicitud de Reserva</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <p>Anexo 834, Anexo 766 o a soporte@gorebiobio.cl</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-bug"></i> Calendario de Reservas Hardware</div>

                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

