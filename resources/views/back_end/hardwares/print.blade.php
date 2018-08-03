<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial;
        }

        .coupon {
            border: 1px dotted #bbb;
            width: 90%;
            border-radius: 10px;
            margin: 0 auto;
            max-width: 600px;
        }

        .container {
            padding: 2px 5px;
            background-color: #f1f1f1;
        }

        .promo {
            background: #ccc;
            padding: 3px;
        }

        .expire {
            color: red;
        }
    </style>
</head>
<body  onload="self.print();">

<div class="coupon">
    <div class="container">
        <h4><b>
                <center>PRESTAMO EQUIPOS</center>
            </b></h4>
    </div>
    <div class="container" style="background-color:white">
        <center>ID: {{ $reserva -> idReserva }}</center>
        <h4>EQUIPO:
            <br>{{ $reserva -> nombreHardware }} {{ $reserva -> marcaHardware }} {{ $reserva -> modeloHardware }}</h4>
        <h5>Funcionario: <br>{{ $reserva -> usuarioReserva }}</h5>
        <h5>Inicio Prestamo: <br>{{ date("d/m/Y H:i:s",strtotime($reserva -> fecIniReserva))  }}</h5>
        <h5>Fin Prestamo: <br>{{ date("d/m/Y H:i:s",strtotime($reserva -> fecFinReserva))  }}</h5>
        <br>
        <div class="coupon">
            <h6>
                <center>FIRMA DEVOLUCIÓN</center>
            </h6>
            <br>
            <br>
            <br>
        </div>
        <p></p>
    </div>
    <div class="container">
        <p>
        <center><small>{{ $reserva -> name }}</small></center>
        </p>
        <p>
        <center>UNIDAD INFORMATICA <br> GORE BIOBIO</center>
        </p>
    </div>
</div>

</body>
</html>
