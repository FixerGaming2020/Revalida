<?php

include_once '../conf/BDConexion.php';
session_start();
$print = "";
$cuis = "";

// RECIBE LOS DATOS ENVIADOS POR AJAX
$cuil = $_POST['cuil'];
$nombre = $_POST['nombre'];
$legajo = $_POST['legajo'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$desde = date("d/m/y", strtotime($desde));
$desde = str_replace("/","",$desde);
$hasta = date("d/m/y", strtotime($hasta));
$hasta = str_replace("/","",$hasta);

$clientes = "select cuit from [8empleadosBanco]";
$cuits = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $clientes);
 while ($row = sqlsrv_fetch_array($cuits, SQLSRV_FETCH_ASSOC)) {
            $cuis = $cuis . "{$row['cuit']},";
        }
$cuis = trim($cuis, ',');

// ESTRUCTURA LA CONSULTA SQL A PARTIR DE LOS CAMPOS RECIBIDOS
$query = "select * from openquery(M4000SF, 'Select 		cl.SNO_CLIEN NOMBRE,
														TO_CHAR (TO_DATE(LPAD(fi.SFE_NACIM, 6,''0'') , ''DDMMRRRR'') , ''YYYY-MM-DD'') EDAD
														FROM sfb_bsado a 
														inner join sfb_bsmcl cl ON cl.SCO_IDENT = a.SCO_IDENT
														inner join sfb_bsmfi fi ON fi.SCO_IDENT = a.SCO_IDENT
														WHERE  
														a.snu_docum in (".$cuis.")
														')
									";

if (isset($cuil) && $cuil != null) {
    //si tiene cuenta empieza el where
    $query = $query . " WHERE CUIL = " . $cuil;
    if (isset($nombre) && $nombre != null) {
        //si tiene sucursal agrega en and
        $query = $query . " AND NOMCUENTA LIKE '%" . $nombre . "%'";
    } 
} else {				
    //no tiene cuenta
    if (isset($nombre) && $nombre != null) {
        //si tiene sucursal agrega en and
        $query = $query . " WHERE NOMCUENTA LIKE '%" . $nombre . "%'";
    } 
}

// SE EJECUTA LA CONSULTA
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

$_SESSION['buscar'] = $query;


if ($result) {
    $filas = sqlsrv_has_rows($result);
    if ($filas) {
        $print = "<br>
        <table id='tb_buscar_cobranzasTC' class='table table-striped table-bordered' border='3' style='width: 100%'>
                                    <thead style='background-color:#1d6091;color:white;'>
                                        <tr>
                                            <th>Nombre</th>
											<th>Edad</th>
                                        </tr>
            </thead>
        <tbody>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$nombre = utf8_encode($row['NOMBRE']);
			$cumpleanos = new DateTime($row['EDAD']);
			$hoy = new DateTime();
			$annos = $hoy->diff($cumpleanos);
            $print = $print . "
            <tr>
                <td>{$nombre}</td>
				<td>{$annos->y}</td>
            </tr>";
        }
        $print = $print . "</tbody></table>
        ";
    } else {
        // SE EJECUTO LA CONSULTA Y NO SE ENCONTRARON RESULTADOS
        $print = '<br><div class="alert alert-warning text-center" role="alert"> No se encontraron resultados para el filtro ingresado</div>';
    }
} else {
    // OCURRIO UN ERROR 
    $print = '<br><div class="alert alert-danger text-center" role="alert"> No se pudo realizar la búsqueda </div>';
    echo $query;
}

echo $print;


