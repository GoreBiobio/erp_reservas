@extends('adminlte::layouts.publico')
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

    <div class="container">
        <div class="row">
            <div class="col-md-3  no-print">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Reserva de Hardware</h4>
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
                            @foreach($hard_lista as $hard_lista)
                                <form action="/Publico/Publico" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="tipo" value="Hardware">
                                    <input type="hidden" name="idItem" value="{{ $hard_lista -> idHardware }}">
                                    <button type="submit" class="btn btn-block btn-flat"
                                            style="color: #ffffff; background-color: {{ $hard_lista->colorHardware }}">
                                        <strong>{{ $hard_lista -> nombreHardware }}
                                            - {{ $hard_lista -> marcaHardware }} {{ $hard_lista -> modeloHardware }}</strong>
                                    </button>
                                </form><br>
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

