@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Reservas Hardware
@endsection
@section('contentheader_title')
    Reservas Hardware
@endsection
@section('contentheader_description')
    / Gestión
@endsection
@section('main-content')

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <i class="fa fa-bug"></i>
                <h3 class="box-title">Nueva Reserva de Hardwares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/Reservas/GuardarReservaHardware" method="POST" class="form-horizontal">
                    <!-- text input -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="rut">Fecha Inicio Reserva</label>
                            <input class="form-control" type="date" name="fini" required>
                        </div>

                        <div class="col-md-2">
                            <label for="nombres">Hora Inicio Reserva</label>
                            <input class="form-control" type="time" name="hini" required>
                        </div>

                        <div class="col-md-4">
                            <label for="rut"><strong>Hardware a Reservar</strong></label>
                            <select class="form-control" name="idhardware">
                                @foreach($hardwares as $hardwares)
                                    <option
                                        value="{{ $hardwares->idHardware }}">{{ $hardwares -> nombreHardware }}
                                        - {{ $hardwares -> marcaHardware }} {{ $hardwares -> modeloHardware}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="rut">Fecha Fin Reserva</label>
                            <input class="form-control" type="date" name="ffin" required>
                        </div>

                        <div class="col-md-2">
                            <label for="nombres">Hora Fin Reserva</label>
                            <input class="form-control" type="time" name="hfin" required>
                        </div>
                    </div>

                    <!-- text input -->
                    <div class="form-group">

                        <div class="col-md-4">
                            <label for="nombres">Nombre de la Reserva</label>
                            <input type="text" class="form-control" name="nombrereserva" value=""
                                   placeholder="Reserva para Reunión Diplade" minlength="5" maxlength="50" required>
                        </div>

                        <div class="col-md-4">
                            <label for="nombres"><strong>Funcionario que requiere Reserva</strong></label>
                            <input type="text" class="form-control" name="usuarioreq" value=""
                                   placeholder="Nombre Funcionario" minlength="10" maxlength="25" required>
                        </div>

                        <div class="col-md-4">
                            <label for="nombres">Funcionario que registra Reserva</label>
                            <input type="hidden" name="idInfo" value="{{ Auth::user()->idFuncUser }}">
                            <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                   placeholder="Teléfono Personal" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="telefono">Detalle de la Reserva:</label>
                            <textarea class="form-control" name="detallereserva" rows="3"
                                      placeholder="Ingrese el detalle de la reserva."></textarea>
                        </div>
                        <input type="hidden" name="tiporeserva" value="Hardwares">
                        <input type="hidden" name="estadoreserva" value="Activa">

                    </div>
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                        <button id="btn" class="btn btn-success pull-right">Ingresar Nueva Reserva</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reservas Activas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Inicio Reserva</th>
                        <th>Fecha Fin Reserva</th>
                        <th>Hardware</th>
                        <th>Funcionario Reserva</th>
                        <th>Observaciones Reserva</th>
                        <th>Estado</th>
                        <th>Reservado Por</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lista_reservas as $lista_reservas)
                        <tr>
                            <td>
                                <center>{{ $lista_reservas -> idReserva }}</center>
                            </td>
                            <td>{{ date("d/M/Y H:i:s",strtotime($lista_reservas -> fecIniReserva))  }}</td>
                            <td>{{ date("d/M/Y H:i:s",strtotime($lista_reservas -> fecFinReserva)) }}</td>
                            <td>
                                <button type="button" class="btn btn-block btn-xs"
                                        style="color: #ffffff; background-color: {{ $lista_reservas->colorHardware }}">
                                    <strong>{{ $lista_reservas -> nombreHardware }}
                                        - {{ $lista_reservas -> marcaHardware }} {{ $lista_reservas -> modeloHardware}}</strong>
                                </button>
                            </td>
                            <td>
                                <center>{{ $lista_reservas -> usuarioReserva }}</center>
                            </td>
                            <td>{{ $lista_reservas -> obsReserva }}</td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-block btn-xs"
                                            style="color: #ffffff; background-color: #6dc066">
                                        <strong>{{ $lista_reservas -> estadoReserva }}</strong>
                                    </button>
                                </center>
                            </td>
                            <td>
                                <center>{{ $lista_reservas -> name }}</center>
                            </td>
                            <td>
                                <center>
                                    <form action="/Reservas/AnularReservaHardware" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="idReserva"
                                               value="{{ $lista_reservas -> idReserva }}">
                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                class="fa fa-calendar-minus-o"></i>
                                            ANULAR RESERVA
                                        </button>
                                    </form>
                                </center>
                                <br>
                                <center>
                                    <form action="/Hardwares/Print" method="GET">
                                        <input type="hidden" name="idReserva" value="{{ $lista_reservas -> idReserva }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Voucher"/>
                                    </form>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection


