<?php
include_once '../../conf/Constants.php';
include_once '../../conf/BDConexion.php';
include_once '../../conf/Log.php';
session_start();

$Log = new Log();
$tabla = array(); //creo un array para luego guardar los datos que se obtienen por POST
$legajo = $_SESSION['usuario'];
$apellido = $_SESSION['apellido'];
$nombre = $_SESSION['user'];
$cargo = $_SESSION['cargo'];
$gerencia = $_SESSION['gerencia'];
$idUsuario = $_SESSION['id'];


$tabla = ($_POST['tabla']); //guardo los datos en el array creado

$tablas = $tabla[3]; //obtengo toda la fila 3 del multiarray, donde obtengo (solicitud,plataforma,servicio)
$aplicacion = $tabla[4]; //obtengo toda la fila 4 del multiarray, donde obtengo(aplicaciones)

$tab = explode(',', $tablas); //con el explode, divido por coma y se guarda en un array.
$api = explode(",", $aplicacion); //con el explode, divido por coma y se guarda en un array.


//recorro el array de aplicaciones para poder agregarle las comillas y luego hacer la consulta a  la Base de Datos
for ($i = 0; $i < sizeof($api); $i++) {
    $string = $api[$i];
    unset($api[$i]);
    $api[$i] = "'" . $string . "'";
}

$motivo = $tab[0]; //obtengo motivo
$plataforma = $tab[1]; //obtengo plataforma
$servicio = $tab[2]; //obtengo servicio

$aplicaciones = (string) implode(",", $api); // guardo cada una de las aplicacions y las convierto en un string.




//-------------------------------LLAMADAS A LA BASE DE DATOS------------------------------------------------------


//insersion de datos en la tabla FORMULARIOS
try {
    $query = "INSERT INTO formulario (motivoSolicitud,plataforma,servicio,uLegajo,uApellido,uNombre,uCargo,uGerencia,usuario,estado) VALUES ('$motivo','$plataforma','$servicio','$legajo','$apellido','$nombre','$cargo',$gerencia,$idUsuario,1)";
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
} catch (Exception $e) {
}

$Log->writeLine($query);
//obtengo el ultimo id del formulario
try {
    $query1 = "SELECT MAX(id) AS id FROM formulario";
    $result1 = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query1);
} catch (Exception $e) {
}

//obtengo las aplicaciones que se seleccionaron
try {
    $query2 = "SELECT id FROM aplicativo p where p.nombre in (" . $aplicaciones . ") ";
    $result2 = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query2);
} catch (Exception $e) {
}

//guardo la relacion entre el formulario y la aplicacion
if ($result) {
    if (sqlsrv_has_rows($result)) {

        $row = sqlsrv_fetch_array($result1);

        while ($row1 = sqlsrv_fetch_array($result2)) {
            try {
                $query3 = "INSERT INTO formulario_aplicativo (id_formulario,id_aplicativo) VALUES ('$row[id]','$row1[id]')";
                $result3 = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query3);
            } catch (Exception $e) {
            }
        }
    }
}
