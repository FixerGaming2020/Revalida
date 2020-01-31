<div class="modal fade" id="mdCargarPermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">ALTA DE PERMISO</h4>
            </div>
            <div class="modal-body">
                <form id="formCargarPermiso" name="formCargarPermiso" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre:</label> 
                        <div class="col">
                            <input type="text" class="form-control mb-2" id="nombrePermiso" name="nombrePermiso" maxlength="50" placeholder="Nombre de permiso" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type='submit' class='btn btn-success' id='btnCargarPermiso' value='Guardar'>
                <input type='submit' class='btn btn-outline-secondary' id='btnCancelarCarga' value='Cancelar'>
            </div>
        </div>
    </div>
</div>