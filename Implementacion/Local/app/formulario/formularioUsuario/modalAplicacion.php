<?php
include_once '../../conf/Constants.php';
include_once '../../conf/Log.php';
include_once '../../conf/BDConexion.php';

$query = "SELECT * FROM aplicativo";
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
$cont = 0;
?>

<head>
    <link rel="stylesheet" href="../../../lib/css/checkboxModal.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="modal fade" id="mdAplicacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">LISTADO DE APLICACIONES</h4>
                </div>
                <?php if ($result) {
                    if (sqlsrv_has_rows($result)) { ?>
                        <div class="modal-body">
                            <div class="row">
                                <?php while ($row = sqlsrv_fetch_array($result)) { ?>
                                    <div class="col-md-5" style="margin: 0 0 1rem;">
                                        <p>
                                            <input type="checkbox" id=<?php echo $row['id']; ?> value=<?php echo $row['nombre']; ?> />
                                            <!-- <input  type="checkbox" id="sfb" name="sfb[]" value=<?php echo $row['nombre']; ?>/> -->
                                            <label for=<?php echo $row['id']; ?>><?php echo $row['nombre']; ?></label>
                                        </p>
                                    </div>
                                <?php $cont++;
                                } ?>
                            </div>
                        </div>
                <?php }
                } ?>
                <div class="modal-footer">
                    <input type='submit' class='btn btn-info' id='btnConfirmar' name='btnConfirmar' value='Confirmar'>
                    <input type='submit' class='btn btn-outline-secondary' id='btnCancelarAjuste' value='Cancelar' data-dismiss="modal">
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<!-- SCRIPT QUE OBTIENE LAS APLICACIONES SELECCIONADAS, Y LAS GUARDA EN UN ARRAY QUE LUEGO LO GUARDA EN SESSION Y ENVIA EL RESULTADO POR TEXTO-->
<script>
    $('#btnConfirmar').click(function() {

        var aplicaciones = new Array();
        var i = 0;
        var numeracion = "<?php echo  $cont * 2 ?>";

        current_fs = $(this).parent();
        previous_fs = $(document.getElementById('motivo')).parent();
        var texto = "";
        for (i = 0; i <= numeracion; i++) {
            if ($("#" + i).prop('checked')) {
                aplicaciones.push($("#" + i).val());
                texto = texto + "<p>" + $("#" + i).val() + "</p>";
            }
        }
        sessionStorage.setItem(4, aplicaciones);

        $("td#tabla").html(texto);

        $("#mdAplicacion").modal("toggle");
        return false;


    });
</script>