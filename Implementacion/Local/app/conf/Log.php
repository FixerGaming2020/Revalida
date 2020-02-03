<?php

class Log {

    /** @var string Archivo a escribir. */
    private $archivo;

    function __construct() {
        // $url = LOGS . "\\errores_log.txt";
        // $this->archivo = file_exists($url) ? fopen($url, 'a') : fopen($url, 'w');
    }

    /**
     * Escribe una linea en el archivo indicado.
     * @param string $text Linea de texto a agregar.
     */
    public function errorConexion($text) {
        $hour = date("Y-m-d H:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];
        $uri = $_SERVER["REQUEST_URI"];
        $self = $_SERVER["PHP_SELF"];
        $data = "[{$hour}][{$ip}][{$uri}][{$self}]{$text}" . PHP_EOL;
        fwrite($this->archivo, $data);
    }

    public static function escribirError($texto) {
        $url = LOGS . "\\errores_log.txt";
        $archivo = file_exists($url) ? fopen($url, 'a') : fopen($url, 'w');
        $hour = date("Y-m-d H:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];
        $uri = $_SERVER["REQUEST_URI"];
        $self = $_SERVER["PHP_SELF"];
        $data = "[{$hour}][{$ip}][{$uri}][{$self}]{$texto}" . PHP_EOL;
        fwrite($archivo, $data);
    }

}
