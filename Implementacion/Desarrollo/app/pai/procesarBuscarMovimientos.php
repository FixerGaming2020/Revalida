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
$query = "select * from openquery(M4000SF, 'Select 		           A.ACU_PRODU PRODUCTO,          
                                                                   A.ACU_OFICI SUCURSAL,          
                                                                   A.ACUNUMCUE CUENTA,            
                                                                   A.ACUDIGVER DIGITO,
                                                                   C.HNO_CUENT NOMCUENTA,
                                                                   C.SCO_IDENT CODCLIENTE,
                                                                   TO_CHAR ( TO_DATE ( LPAD(A.tfe_trans, 6,''0'') , ''DDMMRRRR'') , ''DD/MM/YYYY'') PROCESO,
                                                                   TO_CHAR ( TO_DATE ( LPAD(A.afe_valor, 6,''0'') , ''DDMMRRRR'') , ''DD/MM/YYYY'') FECHA,
                                                                   A.DCO_TRANS TRANS,             
                                                                   A.ACO_CAUSA CAUSAL,
                                                                   B.DNO_TRANS DESCRIPCION,
                                                                   A.TNUDOCTRA,            
                                                                   A.SUBCOD MOVIMIENTO,
                                                                   A.TNRO_TARJ TARJETA,           
                                                                   A.DCODEBCRE DEBCRED,           
                                                                   A.TVA_MOVIM MONTO,
																   D.SNU_DOCUM CUIL,
																   A.DCO_USUAR USUARIO
														From sfb_ahahi a, sfb_aamtm b, sfb_ahmol c, 
														(select (c.hcu_ofici ||c.hcunumcue) cuenta, a.scotipdoc, a.snu_docum
														from sfb_bsado a, sfb_bsmcl b, sfb_ahmol c
														where a.sco_ident=b.sco_ident and
														b.sco_ident=c.sco_ident and
														a.scotipdoc in (34,35) and
														c.hcoestcue=1 and  
														a.snu_docum in
	(".$cuis.")) d
									where a.are_valor BETWEEN (to_date(lpad(''".$desde."'', 6 ,''0''),''ddmmrr'')- TO_DATE(''010157'',''ddmmrr'')) 
                                   and (to_date(lpad(''".$hasta."'', 6 ,''0''),''ddmmrr'')- TO_DATE(''010157'',''ddmmrr'')) and
									a.dco_trans=b.dco_trans	and	
									a.aco_causa = b.aco_causa and
									a.acu_ofici=c.hcu_ofici and
									a.acunumcue= c.hcunumcue and 
									(a.acu_ofici ||a.acunumcue) = d.cuenta')
									LEFT JOIN (select cuit,legajo from [8empleadosBanco]) EM ON EM.CUIT = CAST(CUIL AS nvarchar)
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
                                            <th>Producto</th>
											<th style='display:none;'>Sucursal</th>
											<th style='display:none;'>Cuenta</th>
											<th style='display:none;'>Digito</th>
											<th>Legajo</th>
                                            <th>Nombre y Apellido</th>
											<th style='display:none;'>Documento</th>
											<th>Fecha</th>
											<th style='display:none;'>Transaccion</th>
											<th style='display:none;'>Causal</th>
                                            <th>Descripcion</th>
											<th>Usuario</th>
											<th>Movimiento</th>
											<th style='display:none;'>Debito/Credito</th>
											<th>Monto</th>
											<th style='display:none;'>Numero de Tarjeta</th>
											
                                        </tr>
            </thead>
        <tbody>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$nombre = utf8_encode($row['NOMCUENTA']);
			$descripcion = utf8_encode($row['DESCRIPCION']);
			$movimiento = utf8_encode($row['MOVIMIENTO']);
            $print = $print . "
            <tr>
                <td>{$row['PRODUCTO']}</td>
				<td style='display:none;'>{$row['SUCURSAL']}</td>
				<td style='display:none;'>{$row['CUENTA']}</td>
				<td style='display:none;'>{$row['DIGITO']}</td>
				<td>{$row['legajo']}</td>
                <td>{$nombre}</td>
				<td style='display:none;'>{$row['TNUDOCTRA']}</td>
				<td>{$row['PROCESO']}</td>
				<td style='display:none;'>{$row['TRANS']}</td>
				<td style='display:none;'>{$row['CAUSAL']}</td>
				<td>{$descripcion}</td>
				<td>{$row['USUARIO']}</td>
				<td>{$movimiento}</td>
				<td style='display:none;'>{$row['DEBCRED']}</td>
				<td>{$row['MONTO']}</td>
				<td style='display:none;'>{$row['TARJETA']}</td>
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


