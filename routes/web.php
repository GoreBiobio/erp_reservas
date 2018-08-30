<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Publico/Vehiculos', 'Vehiculos@publico');
Route::get('/Publico/Hardwares', 'Hardwares@publico');
Route::get('/Publico/Salones', 'Salones@publico');
Route::get('/Publico/Funcionarios', 'Funcionarios@publico');
Route::get('/Publico/Documentos', 'Documentos@publico');

Route::post('/Publico/Publico','Reservas@publico');

Route::group(['middleware' => 'auth'], function () {

//
// RUTAS OK Y EN ORDEN
//

// RUTAS DE HARDWARE
    Route::get('/Hardwares/Gestion', 'Hardwares@gestion');
    Route::get('/Hardwares/Disponibilidad', 'Hardwares@disponibilidad');
    Route::get('/Hardwares/Terminar', 'Hardwares@terminar');

// RUTAS DE VEHICULOS
    Route::get('/Vehiculos/Gestion', 'Vehiculos@gestion');
    Route::get('/Vehiculos/Disponibilidad', 'Vehiculos@disponibilidad');

// RUTAS DE RESERVA DE VEHICULO
    Route::post('/Reservas/GuardarReservaVehiculo', 'Reservas@guardar_reserva_vehiculo');
    Route::post('/Reservas/AnularReservaVehiculo', 'Reservas@anular_reserva_vehiculo');

// RUTAS DE RESERVA HARDWARE
    Route::post('/Reservas/GuardarReservaHardware', 'Reservas@guardar_reserva_hardware');
    Route::post('/Reservas/AnularReservaHardware', 'Reservas@anular_reserva_hardware');


    Route::get('/Salones/Gestion', 'Salones@gestion');
    Route::get('/Salones/Disponibilidad', 'Salones@disponibilidad');
    Route::post('/Salones/Guardar', 'Salones@guardar');
    Route::post('/Salones/AnularReserva', 'Salones@anular');

    route::get('/Acercade', 'HomeController@acerca_de');

});
