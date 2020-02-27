$(document).ready(function () {


    realizarBusqueda();

    function realizarBusqueda(){
        $.ajax({
            type:'POST',
            url:'../AltaBuscar.php'
        });
    }

});