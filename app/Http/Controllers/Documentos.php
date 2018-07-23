<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Documentos extends Controller
{
    public function publico()
    {

        $documentos = DB::table('documentos')
            ->join('catdocumentos','documentos.catDocumentos_idCatDocs','catdocumentos.idCatDocs')
            ->where('documentos.estadoDocs', 1)
            ->get();

        return view('back_end.documentos.publico',compact('documentos'));

    }
}
