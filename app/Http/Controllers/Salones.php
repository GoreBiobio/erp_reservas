<?php

namespace App\Http\Controllers;

use Calendar;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use datetime;
use DB;

class Salones extends Controller
{

    public function gestion()
    {
        if (Auth::user()->level == 'M12' || Auth::user()->level == 'MENU1' ) {

        $lista_salones = DB::table('salones')
            ->where([
                ['estadoSalon', '=', 'Activo'],
                ['grupoAccesoSalon','=',auth::user()->sublevel]
            ])
            ->get();

        $lista_reservas_activas = DB::table('reservas')
            ->join('salones', 'salones.idSalon', 'reservas.salones_idSalon')
            ->join('users', 'users.id', 'reservas.users_id')
            ->where([
                ['estadoReserva', '=', 'Activa'],
                ['tipoReserva', '=', 'Salones'],
                ['salones.grupoAccesoSalon','=',auth::user()->sublevel]
            ])
            ->get();

        return view('back_end.salones.gestion', [
            'lista_salones' => $lista_salones,
            'lista_reservas' => $lista_reservas_activas
        ]);

        } else {

            return view('back_end.accesonoautorizado');
        }
    }

    public function guardar(Request $request)
    {
        //DE PASO
        $tipo_reserva = $request->input('tiporeserva');

        if ($tipo_reserva == 'Salones') {
            $idSalon = $request->input('idsalon');
            $idVehiculo = null;
            $idHardware = null;

            //SOLO SI ES VEHICULO
            $destino_reserva = null;

        } elseif ($tipo_reserva == 'Hardwares') {
            $idSalon = null;
            $idVehiculo = null;
            $idHardware = null;

            echo 'BBB';
            //SOLO SI ES VEHICULO
            $destino_reserva = null;

        } elseif ($tipo_reserva == 'Vehiculos') {
            $idSalon = null;
            $idVehiculo = null;
            $idHardware = null;

            echo 'CCC';
            //SOLO SI ES VEHICULO
            $destino_reserva = $request->input('XXX');
        }

        DB::table('reservas')->insert([
            'creaReserva' => new datetime(),
            'nombreReserva' => $request->input('nombrereserva'),
            'fecIniReserva' => $request->input('fini') . ' ' . $request->input('hini'),
            'fecFinReserva' => $request->input('ffin') . ' ' . $request->input('hfin'),
            'tipoReserva' => $tipo_reserva,
            'usuarioReserva' => $request->input('usuarioreq'),
            'destinoReserva' => $destino_reserva,
            'obsReserva' => $request->input('detallereserva'),
            'estadoReserva' => $request->input('estadoreserva'),
            'evalReserva' => null,
            'salones_idSalon' => $idSalon,
            'vehiculos_idVehiculo' => $idVehiculo,
            'hardwares_idHardware' => $idHardware,
            'users_id' => Auth::user()->id
        ]);

        return redirect('/Salones/Disponibilidad');

    }

    public function disponibilidad()
    {

        $color = null;

        $events = [];
        $data = $reservas = DB::table('reservas')
            ->where('estadoReserva','=','Activa')
            ->join('salones','salones.idSalon', 'reservas.salones_idSalon')
            ->get();

        $data2 = $reservas = DB::table('salones')
            ->where('estadoSalon','Activo')
            ->get();

            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->nombreReserva.' / Reservado por: '. $value->usuarioReserva,
                    false,
                    new \DateTime($value->fecIniReserva),
                    new \DateTime($value->fecFinReserva),
                    null,
                    [
                        'color' => $value->colorSalon,
                    ]
                );
            }

        $calendar = Calendar::addEvents($events);
        return view('back_end.salones.disponibilidad', compact('calendar','data2'));
    }

    public function anular(Request $request)
    {

        DB::table('reservas')
            ->where('idReserva', $request->input('idReserva'))
            ->update([
                'estadoReserva' => 'Inactiva'
            ]);

        return back();

    }

    public function publico(){
        $color = null;

        $events = [];
        $data = $reservas = DB::table('reservas')
            ->where('estadoReserva','=','Activa')
            ->join('salones','salones.idSalon', 'reservas.salones_idSalon')
            ->get();

        $data2 = $reservas = DB::table('salones')
            ->where('estadoSalon','Activo')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->nombreReserva.' / Reservado por: '. $value->usuarioReserva,
                false,
                new \DateTime($value->fecIniReserva),
                new \DateTime($value->fecFinReserva),
                null,
                [
                    'color' => $value->colorSalon,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);
        return view('back_end.salones.publico', compact('calendar','data2'));
    }
}
