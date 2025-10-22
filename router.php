<?php

class Router {
    private $tablaDeRutas = [];
    private $controladorPorDefecto;

    public function addRuta($url, $controlador, $metodo) {
        $this->tablaDeRutas[$url] = ['controlador' => $controlador, 'metodo' => $metodo];
    }

    public function setRutaPorDefecto($controlador, $metodo) {
        $this->controladorPorDefecto = ['controlador' => $controlador, 'metodo' => $metodo];
    }

    public function route($url) {
        $partesUrl = explode('/', $url);
        $rutaEncontrada = null;

        for ($i = count($partesUrl); $i > 0; $i--) {
            $rutaPotencial = implode('/', array_slice($partesUrl, 0, $i));
            if (array_key_exists($rutaPotencial, $this->tablaDeRutas)) {
                $rutaEncontrada = $rutaPotencial;
                $params = array_slice($partesUrl, $i);
                break;
            }
        }

        if ($rutaEncontrada) {
            $controladorNombre = $this->tablaDeRutas[$rutaEncontrada]['controlador'];
            $metodoNombre = $this->tablaDeRutas[$rutaEncontrada]['metodo'];
        } else {
            $controladorNombre = $this->controladorPorDefecto['controlador'];
            $metodoNombre = $this->controladorPorDefecto['metodo'];
            $params = [];
        }

        $archivoControlador = 'aplicacion/controladores/' . strtolower($controladorNombre) . '.php';

        if (file_exists($archivoControlador)) {
            require_once $archivoControlador;
            $controlador = new $controladorNombre();
            call_user_func_array([$controlador, $metodoNombre], $params);
        } else {
            echo "Error 404: No se encontró el controlador '$controladorNombre'.";
        }
    }
}