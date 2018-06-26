<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Calendar;
use DB;

class Vehiculos extends Controller
{

    public function gestion()
    {

        if (Auth::user()->level == 'M12') {

            $vehiculos = DB::table('vehiculos')
                ->where([
                    ['estadoVehiculo', '=', 'Activo'],
                    ['grupoAccesoVehiculo', '=', auth::user()->sublevel]
                ])
                ->get();

            $lista_reservas_activas = DB::table('reservas')
                ->where([
                    ['estadoReserva', '=', 'Activa'],
                    ['tipoReserva', '=', 'Vehiculos'],
                    ['vehiculos.grupoAccesoVehiculo','=',auth::user()->sublevel]
                ])
                ->join('vehiculos', 'vehiculos.idVehiculo', 'reservas.vehiculos_idVehiculo')
                ->join('users', 'users.id', 'reservas.users_id')
                ->get();

            return view('back_end.vehiculos.gestion', [
                'vehiculos' => $vehiculos,
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
            ->join('vehiculos', 'vehiculos.idVehiculo', 'reservas.vehiculos_idVehiculo')
            ->get();

        $vehi_lista = DB::table('vehiculos')
            ->where('estadoVehiculo', 'Activo')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                'Destino: '.$value->destinoReserva.' Reserva: '.$value->nombreReserva . ' / Reservado por: ' . $value->usuarioReserva,
                false,
                new \DateTime($value->fecIniReserva),
                new \DateTime($value->fecFinReserva),
                null,
                [
                    'color' => $value->colorVehiculo,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);
        return view('back_end.vehiculos.disponibilidad', compact('calendar', 'vehi_lista'));

    }

    public function publico()
    {

        $color = null;

        $events = [];
        $data = $reservas = DB::table('reservas')
            ->where('estadoReserva', '=', 'Activa')
            ->join('vehiculos', 'vehiculos.idVehiculo', 'reservas.vehiculos_idVehiculo')
            ->get();

        $vehi_lista = DB::table('vehiculos')
            ->where('estadoVehiculo', 'Activo')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                'Destino: '.$value->destinoReserva.' Reserva: '.$value->nombreReserva . ' / Reservado por: ' . $value->usuarioReserva,
                false,
                new \DateTime($value->fecIniReserva),
                new \DateTime($value->fecFinReserva),
                null,
                [
                    'color' => $value->colorVehiculo,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);
        return view('back_end.vehiculos.publico', compact('calendar', 'vehi_lista'));
    }

}
