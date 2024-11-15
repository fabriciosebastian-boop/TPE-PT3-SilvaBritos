<?php

class ApiView
{

    public function response($data, $status)
    {
        header('Content-type: application/json');
        header('HTTP/1.1 ' . $status . " " . $this->_requestStatus($status));

        echo  json_encode($data);
    }

    private function _requestStatus($code)
    {
        $status = array(
            200 => "OK",
            400 => "BAD REQUEST",
            404 => "NOT FOUND",
            500 => "Internal Server Error",
            201 =>"CREATED",

        );
        //Verifica si el Status tiene algo, si lo tiene, lo devuelve, y sino, devuelve un 500 que es un error general.

        return (isset($status[$code])) ? $status[$code] : $status[500];
    }
}