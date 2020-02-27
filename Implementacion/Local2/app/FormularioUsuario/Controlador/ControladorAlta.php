<?php 

class ControladorAlta {
    private  $mensaje;


    public function getMessage(){
        return $this->mensaje;
    }

    public function buscarUltimasAltas() {
        $resultado = Formulario::listarUltimasAltas();
        $this->mensaje = Formulario::getMensaje();
        return $resultado;
    }

}

?>