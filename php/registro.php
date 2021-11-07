<?

#formulario de insertar registro

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
ob_start();
require 'db.php';
session_start();

$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

//Recibo datos desde ajax
// Escapar de todas las variables de $_POST para protegerse de las inyecciones SQL

// Datos personales
$documento = $mysqli->escape_string($_POST['documento']);
$nombre = $mysqli->escape_string($_POST['nombre']);
$apellidos = $mysqli->escape_string($_POST['apellido']);
$telefono = $mysqli->escape_string($_POST['telefono']);

//Datos de seguridad
$correo = $mysqli->escape_string($_POST['correo']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string(md5(rand(0,1000)));

// Comprobar si el usuario con ese numero de documento ya existe
$validarDocumento = $mysqli->query("SELECT id FROM usuarios WHERE id = '$documento'") or die($mysqli->error());
// Comprobar si el usuario con ese correo ya existe
$validarCorreo = $mysqli->query("SELECT correo  FROM login WHERE correo = '$correo'") or die($mysqli->error());

if ( $validarDocumento->num_rows > 0 || $validarCorreo->num_rows > 0) {
    $arr = array('message' => 'El usuario con ese documento o correo ya existe');
    echo json_encode($arr);
} else {
    // procedemos a guardar usuario
    $newUsuario = "INSERT INTO usuarios (id, nombre, apellido, telefono, ciudad , direccion)" 
                    ."VALUES ('$documento', '$nombre', '$apellidos', '$telefono', '$ciudad', '$direccion')";
    // Agregar usuario a la base de datos
    if ( $mysqli->query($newUsuario) ){
        $logIn = "INSERT INTO login (usuario_id, correo, password , hash)" 
                ."VALUES ('$documento','$correo', '$password', '$hash')";
        // Agregar login a la base de datos       
        if ( $mysqli->query($logIn) ) {   
            $arr = array('message' => 'Usuario creado OK');
            echo json_encode($arr);
        } else { //limpiar Usuario si falla el logIn
            $limpiarUsuario = $mysqli->query("DELETE FROM usuarios WHERE id = '$documento'") or die($mysqli->error());
            $arr = array('message' => 'Registro fallido clean data');
            echo json_encode($arr);
        }
    } else {
        $arr = array('message' => 'Registro fallido');
        echo json_encode($arr);
    }
}
$mysqli->close();
ob_end_flush();
?>