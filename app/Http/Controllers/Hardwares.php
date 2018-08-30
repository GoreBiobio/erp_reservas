<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Calendar;
use DB;
use Illuminate\Http\Request;

class Hardwares extends Controller
{


    public function gestion()
    {

        if (Auth::user()->level == 'MENU3') {

            $hardwares = DB::table('hardwares')
                ->where([
                    ['estadoHardware', '=', 'Activo'],
                    ['grupoAccesoHardware', '=', auth::user()->sublevel]
                ])
                ->get();

            $lista_reservas_activas = DB::table('reservas')
                ->where([
                    ['estadoReserva', '=', 'Activa'],
                    ['tipoReserva', '=', 'Hardwares'],
                    ['evalReserva', '=', null],
                    ['hardwares.grupoAccesoHardware', '=', auth::user()->sublevel]
                ])
                ->join('hardwares', 'hardwares.idHardware', 'reservas.hardwares_idHardware')
                ->join('users', 'users.id', 'reservas.users_id')
                ->get();

            return view('back_end.hardwares.gestion', [
                'hardwares' => $hardwares,
                'lista_reservas' => $lista_reservas_activas
            ]);
        } else {

            return view('back_end.accesonoautorizado');
        }

    }

    public function disponibilidad()
    {

        $color = null;

        $events = [];
        $data = $reservas = DB::table('reservas')
            ->where('estadoReserva', '=', 'Activa')
            ->join('hardwares', 'hardwares.idHardware', 'reservas.hardwares_idHardware')
            ->get();

        $hard_lista = DB::table('hardwares')
            ->where('estadoHardware', 'Activo')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->nombreReserva . ' / Reservado por: ' . $value->usuarioReserva,
                false,
                new \DateTime($value->fecIniReserva),
                new \DateTime($value->fecFinReserva),
                null,
                [
                    'color' => $value->colorHardware,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);
        return view('back_end.hardwares.disponibilidad', compact('calendar', 'hard_lista'));

    }

    public function publico()
    {

        $color = null;

        $events = [];
        $data = $reservas = DB::table('reservas')
            ->where('estadoReserva', '=', 'Activa')
            ->join('hardwares', 'hardwares.idHardware', 'reservas.hardwares_idHardware')
            ->get();

        $hard_lista = DB::table('hardwares')
            ->where('estadoHardware', 'Activo')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->nombreReserva . ' / Reservado por: ' . $value->usuarioReserva,
                false,
                new \DateTime($value->fecIniReserva),
                new \DateTime($value->fecFinReserva),
                null,
                [
                    'color' => $value->colorHardware,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);
        return view('back_end.hardwares.publico', compact('calendar', 'hard_lista'));

    }

    public function print(Request $request)
    {
        $idReserva = $request->input('idReserva');

        $reserva = DB::table('reservas')
            ->join('users', 'reservas.users_id', 'users.id')
            ->join('hardwares', 'reservas.hardwares_idHardware', 'hardwares.idHardware')
            ->where('idReserva', $idReserva)
            ->first();

        return view('back_end.hardwares.print', compact('reserva'));
    }

    public function terminar(Request $request)
    {
        $id = Auth::id();

        DB::table('reservas')
            ->where('idReserva', $request->input('idReserva'))
            ->update(
                ['evalReserva' => 'OK']
            );

        DB::table('reservas')
            ->where('idReserva', $request->input('idReserva'))
            ->update(
                ['idrecep' => $id]
            );

        return $this->gestion();

    }

}
