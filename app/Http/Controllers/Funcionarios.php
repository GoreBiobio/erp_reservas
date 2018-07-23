<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Funcionarios extends Controller
{
    public function publico()
    {
        $funcionarios = DB::table('funcionarios')
            ->join('estamentos', 'funcionarios.estamentos_idEstamentos', 'estamentos.idEstamentos')
            ->where('funcionarios.estadoFunc', 1)
            ->get();

        return view('back_end.funcionarios.publico', compact('funcionarios'));
    }
}
