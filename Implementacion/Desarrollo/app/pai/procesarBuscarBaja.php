<?php

include_once '../conf/BDConexion.php';
session_start();
$print = "";

// RECIBE LOS DATOS ENVIADOS POR AJAX
$cuil = $_POST['cuil'];
$nombre = $_POST['nombre'];
$legajo = $_POST['legajo'];


// ESTRUCTURA LA CONSULTA SQL A PARTIR DE LOS CAMPOS RECIBIDOS
$query = "SELECT * FROM [8empleadosBanco] ";

if (isset($cuil) && $cuil != null) {
    //si tiene cuenta empieza el where
    $query = $query . " WHERE cuit LIKE '%" . $cuil . "%'";
    if (isset($nombre) && $nombre != null) {
        //si tiene sucursal agrega en and
        $query = $query . " AND nombre LIKE '%" . $nombre . "%'";
		if (isset($legajo) && $legajo != null) {
        //si tiene sucursal agrega en and
        $query = $query . " AND legajo LIKE '%" . $legajo . "%'";
    } 
    } else{
		if (isset($legajo) && $legajo != null) {
        //si tiene sucursal agrega en and
        $query = $query . " AND legajo LIKE '%" . $legajo . "%'";
    }
	} 
} else {				
    //no tiene cuenta
    if (isset($nombre) && $nombre != null) {
        //si tiene sucursal agrega en and
        $query = $query . " WHERE nombre LIKE '%" . $nombre . "%'";
		if (isset($legajo) && $legajo != null) {
        //si tiene sucursal agrega en and
        $query = $query . " AND legajo LIKE '%" . $legajo . "%'";
    }
    }else{
		if (isset($legajo) && $legajo != null) {
        //si tiene sucursal agrega en and
        $query = $query . " WHERE legajo LIKE '%" . $legajo . "%'";
    }
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
                                            <th>CUIL</th>
                                            <th>Nombre y Apellido</th>
											<th>Legajo</th>
                                            <th>Eliminar</th>
											<th>Modificar</th>
                                        </tr>
            </thead>
        <tbody>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $nombre = utf8_encode($row['nombre']);
            $print = $print . "
            <tr>
                <td>{$row['cuit']}</td>
                <td>{$nombre}</td>
				<td>{$row['legajo']}</td>
				<td class='text-center' title='Eliminar Usuario'>
                    <button class='btn btn-sm btn-outline-danger'> 
                        <img src='../../lib/img/DELETE.png' class='detallesCobranzasTC' name='{$row['id']}' width='18' height='18' > 
                    </button>
                </td>
				<td class='text-center' title='Modificar Usuario'>
                    <button class='btn btn-sm btn-outline-warning'> 
                        <img src='../../lib/img/EDIT.png' class='modificarUsuario' name='{$row['id']}' width='18' height='18' > 
                    </button>
                </td>
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


