<?php

class Router {

    function __construct() {
        $this->db = new Database();
        $this->view = new View();
    }

    public function clearUrl($clearUrl) {
        if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
            $corruptUrl = $_SERVER['REQUEST_URI'];
            $pos = strpos($corruptUrl, '?');
            $parametros = explode('&', substr($corruptUrl, $pos + 1));
            $out = "";
            foreach ($parametros as $parametro) {
                $vector = explode('=', $parametro);
                if ($vector[0] && $vector[1]) {
                    $out .= '/' . $vector[0] . '/' . $vector[1];
                }
            }
            redirect($clearUrl . $out);
        }

        //devuelve todos $_GET limpios
        if (!isset($clearUrl)) {
            $clearUrl = null;
        }
        $urlx = $clearUrl;
        $urlx = rtrim($urlx, '/');
        $urlx = explode('/', $urlx);

        foreach ($urlx as $part) {
            $part_semi_clean = xss_clean($part);
            $part_semi_clean = htmlEncode($part_semi_clean);
            $url[] = addslashes($part_semi_clean);
        }
        return $url;
    }

    public function getController($clearUrl) {
        if (empty($clearUrl[0])) {
            return $clearUrl[0] = DEFAULT_CONTROLLER;
        } else {
            return $clearUrl[0];
        }
    }

    public function getMethod($clearUrl) {
        if (empty($clearUrl[1])) {
            $accion = 'index';
            return $accion;
        } else {
            return $clearUrl[1];
        }
    }

    public function getParameters($clearUrl) {
        if (empty($clearUrl[2])) {
            return null;
        } else {
            $parametros = array_slice($clearUrl, 2);
            $args = null;
            $total = count($parametros);
            for ($i = 0; $i < $total; $i++) {
                if (($i + 1) != $total) {
                    $args[$parametros[$i]] = $parametros[$i + 1];
                } else {
                    $args[$parametros[$i]] = '';
                }
                $i++;
            }
            return $args;
        }
    }

    public function loadController($controladorDestino) {
        $file = C_PATH . $controladorDestino . '.php';
        $controller_name = $controladorDestino . '_Controller';
        if (file_exists($file)) {
            require $file;

            $controller = new $controller_name;
            return $controller;
        } else {
            return false;
        }
    }
}
