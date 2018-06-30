<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datetime;
use Calendar;
use DB;

class Reservas extends Controller
{

    public function guardar_reserva_hardware(Request $request)
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
            $idHardware = $request->input('idhardware');

            $t = $request->input('fini') . ' ' . $request->input('hini');
            $t2 = $request->input('ffin') . ' ' . $request->input('hfin');

            $fechaRes = DB::table('reservas')
                ->whereRaw('hardwares_idHardware = ? 
                AND estadoReserva = ?
                AND( ? BETWEEN fecIniReserva AND fecFinReserva 
                OR ? BETWEEN fecIniReserva AND fecFinReserva
                OR fecIniReserva >= ? AND fecIniReserva <= ?)',
                    [$idHardware, 'Activa', $t, $t2, $t, $t2])
                ->get();

            $contador = count($fechaRes);

            if ($contador == 1) {
                return redirect('/Hardwares/Disponibilidad')->with('error', '¡Error, ya existe una reserva para el Item!');
            } elseif ($contador == 0) {
                DB::table('reservas')->insert([
                    'creaReserva' => new datetime(),
                    'nombreReserva' => $request->input('nombrereserva'),
                    'fecIniReserva' => $request->input('fini') . ' ' . $request->input('hini'),
                    'fecFinReserva' => $request->input('ffin') . ' ' . $request->input('hfin'),
                    'tipoReserva' => $tipo_reserva,
                    'usuarioReserva' => $request->input('usuarioreq'),
                    'destinoReserva' => null,
                    'obsReserva' => $request->input('detallereserva'),
                    'estadoReserva' => $request->input('estadoreserva'),
                    'evalReserva' => null,
                    'salones_idSalon' => $idSalon,
                    'vehiculos_idVehiculo' => $idVehiculo,
                    'hardwares_idHardware' => $idHardware,
                    'users_id' => Auth::user()->id
                ]);
                return redirect('/Hardwares/Disponibilidad')->with('status', '¡Se ha reservado con éxito!');
            } else {
                return redirect('/Hardwares/Disponibilidad')->with('error', '¡Error, ya existe una reserva para el Item!');
            }
        }
    }

    public function anular_reserva_hardware(Request $request)
    {

        DB::table('reservas')
            ->where('idReserva', $request->input('idReserva'))
            ->update([
                'estadoReserva' => 'Inactiva'
            ]);

        return back();
    }

    public function guardar_reserva_vehiculo(Request $request)
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
            $idHardware = $request->input('idhardware');

            //SOLO SI ES VEHICULO
            $destino_reserva = null;

        } elseif ($tipo_reserva == 'Vehiculos') {
            $idSalon = null;
            $idVehiculo = $request->input('idvehiculo');
            $idHardware = null;

            //SOLO SI ES VEHICULO
            $destino_reserva = $request->input('destino');
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

        return redirect('/Vehiculos/Disponibilidad');

    }

    public function anular_reserva_vehiculo(Request $request)
    {

        DB::table('reservas')
            ->where('idReserva', $request->input('idReserva'))
            ->update([
                'estadoReserva' => 'Inactiva'
            ]);

        return back();

    }

    public function publico()
    {
    }
}
