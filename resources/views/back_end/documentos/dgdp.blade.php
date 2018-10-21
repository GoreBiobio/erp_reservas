@extends('adminlte::layouts.publico_two')
@section('htmlheader_title')
    Documentos
@endsection
@section('contentheader_title')
    Documentos
@endsection
@section('contentheader_description')
    / Listado de Documentos Departamento de Gestión y Desarrollo de Personas
@endsection
@section('main-content')

    <div class="container">
        <div class="row">
            <div class="col-md-3  no-print">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Documentos</h4>
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
                        <h4 class="box-title">Informaciones</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                        </div>
                        <p>Para informar un error, contáctese al Anexo 766 o al 834.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-archive"></i> Repositorio de Documentos Departamento Gestión y Desarrollo de Personas</div>
                    <div class="panel-body">
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 100px;">Fecha
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 297px;">Nombre Documento
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 100px;">Descargar
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 322px;">Área Documento
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($documentos as $listado)
                                                <tr>
                                                    <td>{{ $listado -> fechaDocs }}</td>
                                                    <td>{{ $listado -> nombreDocs }}</td>
                                                    <td>
                                                        <center><a href="{{ $listado -> urlDocs }}" target="_blank"
                                                                   class="btn btn-xs btn-default"><i
                                                                    class="fa fa-file-pdf-o"></i></a>
                                                        </center>
                                                    </td>
                                                    <td>{{ $listado -> categoriaDocs }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

