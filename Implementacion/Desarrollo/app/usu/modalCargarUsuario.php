<div class="modal fade" id="mdCargarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">ALTA DE USUARIO</h4>
            </div>
            <div class="modal-body">
                <?php
                if ($roles && sqlsrv_has_rows($roles)) {
                    echo '
                        <form id="formCargarUsuario" name="formCargarUsuario" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Legajo:</label> 
                                <div class="col">
                                   <input type="text" class="form-control mb-2" id="legajoUsuario" name="legajo" maxlength="7" placeholder="Legajo de usuario" required>
                                </div>
                            <div class="w-100"></div>
                                <label class="col-sm-2 col-form-label">Nombre:</label> 
                                <div class="col">
                                   <input type="text" class="form-control mb-2" id="nombre" name="nombre" maxlength="100" placeholder="Nombre de usuario" required>
                                </div>
                            <div class="w-100"></div>
                                <label class="col-sm-2 col-form-label">Rol:</label> 
                                <div class="col">
                                    <select class="form-control mb-2" id="rol" name="rol">';
                    while ($row = sqlsrv_fetch_array($roles, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='{$row['id_rol']}'>{$row['nombre']}</option>";
                    }
                    echo '            </select>
                                </div>
                            </div>   
                        </form>';
                } else {
                    echo '<div class="alert alert-danger text-center" role="alert"> No se obtuvieron roles para cargar el formulario </div>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <input type='submit' class='btn btn-success' id='btnCargarUsuario' value='Guardar'>
                <input type='submit' class='btn btn-outline-secondary' id='btnCancelarCarga' value='Cancelar' >
            </div>
        </div>
    </div>
</div>