    
    $(document).ready(function(){
        $("#btnNuevo").click(function(){     
            agregar();
        });
            $("#btnBorrar").click(function(){
                eliminar(id_fila_selected);
            });
        });
    
        var cont=0;
        var id_fila_selected;
        function agregar(){
        cont ++;
        var fila = '<tr class="selected id=fila'+cont+'" onclick="seleccionar(this.id);">'+
        '<td><input type="text" class="form-control"></td>'+
        '<td><input type="text" class="form-control"></td>'+
        '<td><input type="text" class="form-control"></td>'+
        '<td><input type="text" class="form-control"></td>'+
        '<td><input type="text" class="form-control"></td>'+
        '<td><input type="text" class="form-control"></td>'+
        '<tr>';
        $('#tableCobranza').append(fila);
        }

        function seleccionar(id_fila){
            if( $('#'+id_fila).hasClass('seleccionada')){
                $('#'+id_fila).removeClass('seleccionada')
            }else{
                $('#'+id_fila).addClass('seleccionada')
            }
            id_fila_selected=id_fila;
        }


        function eliminar(id_fila){
            $('#'+id_fila).remove();
        }