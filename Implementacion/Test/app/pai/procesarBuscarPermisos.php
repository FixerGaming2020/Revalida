<?php

include_once '../conf/BDConexion.php';
session_start();
$print = "";

// RECIBE LOS DATOS ENVIADOS POR AJAX
$legajo = $_POST['legajo'];
$nombre = $_POST['nombre'];
$sistema = $_POST['sistema'];


// ESTRUCTURA LA CONSULTA SQL A PARTIR DE LOS CAMPOS RECIBIDOS
$query = "SELECT A.legajo,A.nombre,A.perfil,B.nombre nombreSistema,B.jefeGerencia,B.nombreBase
  FROM [BD_Formulario].[dbo].[usuarioAcceso] A
  inner join [BD_Formulario].[dbo].[aplicativo] B ON A.aplicativo = B.id ";

if (isset($legajo) && $legajo != null) {
    $query = $query . " WHERE legajo LIKE '%" . $legajo . "%'";
    if (isset($nombre) && $nombre != null) {
        $query = $query . " AND A.nombre LIKE '%" . $nombre . "%'";
		if (isset($sistema) && $sistema != null) {
        $query = $query . " AND aplicativo " . $sistema;
		}
    } else {
		if (isset($sistema) && $sistema != null) {
        $query = $query . " AND aplicativo " . $sistema;
		} 
	}
} else {				
    if (isset($nombre) && $nombre != null) {
        $query = $query . " WHERE A.nombre LIKE '%" . $nombre . "%'";
		if (isset($sistema) && $sistema != null) {
        $query = $query . " AND aplicativo " . $sistema;
		}
    } else {
		if (isset($sistema) && $sistema != null) {
        $query = $query . " WHERE aplicativo " . $sistema;
		} 
	}
}

// SE EJECUTA LA CONSULTA
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);


if ($result) {
    $filas = sqlsrv_has_rows($result);
    if ($filas) {
        $print = "<br>
		<div id='contenido' style='background: #265d85;'>
        <table id='tb_buscar_cobranzasTC' class='table table-bordered' border='3' style='width: 100%'>
                                    <thead style='background-color:#1d6091;color:white;'>
                                        <tr>
                                            <th>Legajo</th>
											<th>Usuario</th>
                                            <th>Perfil</th>
                                            <th>Sistema</th>
											<th>Gerencia</th>
											<th>Base de Datos</th>
                                        </tr>
            </thead>
        <tbody>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$nombre = utf8_encode($row['nombre']);
			$perfil = utf8_encode($row['perfil']);
			$nombreSistema = utf8_encode($row['nombreSistema']);
			$jefeGerencia = utf8_encode($row['jefeGerencia']);
			$nombreBase = utf8_encode($row['nombreBase']);
            $print = $print . "
            <tr>
				<td>{$row['legajo']}</td>
                <td>{$nombre}</td>
				<td>{$perfil}</td>
				<td>{$nombreSistema}</td>
				<td>{$jefeGerencia}</td>
				<td>{$nombreBase}</td>
            </tr>";
        }
        $print = $print . "</tbody></table></div>
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


