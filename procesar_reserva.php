<?php
// Definir el costo por día de renta
$costoPorDia = 50; // Puedes ajustar este valor según sea necesario

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario y procesarlos como lo necesites
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : "";
    $edad = isset($_POST['edad']) ? $_POST['edad'] : "";
    $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : "";
    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : "";
    $recoleccion = isset($_POST['recoleccion']) ? $_POST['recoleccion'] : "";
    $fecha_recoleccion = isset($_POST['fecha_recoleccion']) ? $_POST['fecha_recoleccion'] : "";
    $hora_recoleccion = isset($_POST['hora_recoleccion']) ? $_POST['hora_recoleccion'] : "";
    $devolucion = isset($_POST['devolucion']) ? $_POST['devolucion'] : "";
    $fecha_devolucion = isset($_POST['fecha_devolucion']) ? $_POST['fecha_devolucion'] : "";
    $hora_devolucion = isset($_POST['hora_devolucion']) ? $_POST['hora_devolucion'] : "";
    $pasajeros = isset($_POST['pasajeros']) ? $_POST['pasajeros'] : "";
    $vehiculo = isset($_POST['vehiculo']) ? $_POST['vehiculo'] : "";
    
    // Generar un número de folio único
    $folio = uniqid('FOLIO_');

    // Calcular la duración del alquiler en días
    $fechaInicio = new DateTime($fecha_recoleccion);
    $fechaFin = new DateTime($fecha_devolucion);
    $diasRenta = $fechaInicio->diff($fechaFin)->days;

    // Calcular el total por los días de renta
    $totalRenta = $diasRenta * $costoPorDia;

    // Generar el HTML del mensaje de reserva exitosa
    $html = "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reserva Exitosa</title>
        <link rel='stylesheet' href='styleconsulta.css'>
    </head>
    <body>
        <div class='recuadro'>
            <img src='imagenes/LOGO.png' alt='Logo de la página' class='logo'>
            <h2>¡Reserva exitosa!</h2>
            <p>Nombre: $nombre $apellidos</p>
            <p>Vehículo: $vehiculo</p>
            <p>Fecha de recolección: $fecha_recoleccion a las $hora_recoleccion</p>
            <p>Fecha de devolución: $fecha_devolucion a las $hora_devolucion</p>
            <p>Días de renta: $diasRenta</p>
            <p>Total a pagar: $$totalRenta</p>
            <p>Su número de folio es: $folio</p>
            <a href='prueba.php' class='cerrar'>Cerrar</a>
        </div>
    </body>
    </html>";

    echo $html;
}
?>

