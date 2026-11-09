
<?php

// Arreglo para almacenar las transacciones
$transacciones = array();

// Funcion para registrar una transaccion
function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;

    $transaccion = array(
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    );

    array_push($transacciones, $transaccion);
}

// Funcion para generar el estado de cuenta
function generarEstadoDeCuenta() {
    global $transacciones;

    $totalContado = 0;

    echo "<h2>Estado de Cuenta</h2>";
    echo "<h3>Detalle de transacciones</h3>";

    // Recorrer las transacciones
    foreach ($transacciones as $transaccion) {
        echo "ID: " . $transaccion["id"] . "<br>";
        echo "Descripcion: " . $transaccion["descripcion"] . "<br>";
        echo "Monto: ₡" . number_format($transaccion["monto"], 2) . "<br><br>";

        $totalContado += $transaccion["monto"];
    }

    // Calcular intereses y cashback
    $interes = $totalContado * 0.026;
    $totalConInteres = $totalContado + $interes;
    $cashback = $totalContado * 0.001;
    $totalFinal = $totalConInteres - $cashback;

    // Crear el contenido del archivo de texto
    $contenido = "ESTADO DE CUENTA\n\n";
    $contenido .= "DETALLE DE TRANSACCIONES\n\n";

    foreach ($transacciones as $transaccion) {
        $contenido .= "ID: " . $transaccion["id"] . "\n";
        $contenido .= "Descripcion: " . $transaccion["descripcion"] . "\n";
        $contenido .= "Monto: ₡" . number_format($transaccion["monto"], 2) . "\n\n";
    }

    $contenido .= "RESUMEN DEL ESTADO DE CUENTA\n";
    $contenido .= "Total de contado: ₡" . number_format($totalContado, 2) . "\n";
    $contenido .= "Interes del 2.6%: ₡" . number_format($interes, 2) . "\n";
    $contenido .= "Total con intereses: ₡" . number_format($totalConInteres, 2) . "\n";
    $contenido .= "Cashback del 0.1%: ₡" . number_format($cashback, 2) . "\n";
    $contenido .= "Total final a pagar: ₡" . number_format($totalFinal, 2) . "\n";

    // Guardar el estado de cuenta en un archivo
    file_put_contents(__DIR__ . "/estado_cuenta.txt", $contenido);

    // Mostrar resumen
    echo "<h3>Resumen del Estado de Cuenta</h3>";
    echo "Total de contado: ₡" . number_format($totalContado, 2) . "<br>";
    echo "Interes del 2.6%: ₡" . number_format($interes, 2) . "<br>";
    echo "Total con intereses: ₡" . number_format($totalConInteres, 2) . "<br>";
    echo "Cashback del 0.1%: ₡" . number_format($cashback, 2) . "<br>";
    echo "<strong>Total final a pagar: ₡" . number_format($totalFinal, 2) . "</strong>";
}

// Registrar transacciones de ejemplo
registrarTransaccion(1, "Compra en supermercado", 12500);
registrarTransaccion(2, "Compra de gasolina", 8500);
registrarTransaccion(3, "Compra de ropa", 15000);
registrarTransaccion(4, "Compra de alimentos", 10000);

// Generar y mostrar el estado de cuenta
generarEstadoDeCuenta();

?>
