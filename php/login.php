<?php

#formulario de validación de logIn

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
ob_start();
require 'db.php';


//Recibo datos desde ajax
// Escapar de todas las variables de $_POST para protegerse de las inyecciones SQL

// Datos de acceso
$correo = $mysqli->escape_string($_POST['correo']);
// Comprobar si el correo si existe
$consulta = $mysqli->query("SELECT * FROM login WHERE correo = '$correo'")or die($mysqli->error());
if ( $consulta->num_rows == 0  ) {
    $arr = array('message' => 'El correo electronico no existe.');
    echo json_encode($arr);
} else {
    $usuario = $consulta->fetch_assoc();
    $documento = $usuario['usuario_id'];
    if ( password_verify($_POST['password'], $usuario['password']) )
    {
        $ActualizarLog = $mysqli->query("UPDATE login SET ultimoLog = now() WHERE usuario_id = '$documento'") or die($mysqli->error());
        $nombre = $mysqli->query("SELECT * FROM usuarios WHERE id = '$documento'")or die($mysqli->error());
        $usuarioData = $nombre->fetch_assoc();
        $userName = $usuarioData['nombre'];
        $userDocument = $usuarioData['id'];

        $response = array();
        $response[0] = array(
            'message' => 'LogIn Ok.',
            'usuario_name'=> $userName,
            'usuario_documento'=> $userDocument,
        );
        echo json_encode($response);

    } else {
        $arr = array('message' => 'Has ingresado una contraseña incorrecta.');
        echo json_encode($arr);
    }
}
$mysqli->close();
ob_end_flush();
?>