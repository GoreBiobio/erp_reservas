@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Acceso Restringido
@endsection
@section('contentheader_title')
    Acceso Restringido
@endsection
@section('contentheader_description')
    / Problemas al cargar credenciales del funcionario.
@endsection
@section('main-content')

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Credenciales!</h4>
        El Usuario logeado no cumple con las credenciales para este apartado, si considera este mensaje un error, favor
        contacte al Administrador del Sistema (AS).
    </div>

@endsection

