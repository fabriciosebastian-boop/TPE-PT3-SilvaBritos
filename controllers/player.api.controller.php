<?php
require_once 'views/apiView.php';
require_once 'models/jugadores.model.php';

class playerApiController{
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new JugadoresModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");

    }
    public function getAllplayers($params = []){
            $playersArr = [];
            if(!isset($params[':sort_filter']) && ! isset($params[':sort_mode'])){
                $playersArr = $this->model->getAllPlayers();
            }else{
                if (!$this->validateOrder($params[':sort_filter'], $params[':sort_mode'])) {
                    return $this->view->response("no especificaste ordenamiento valido", 400);
                }

                $sort_filter = $params[':sort_filter'];
                $sort_mode = $params[':sort_mode'];
                $playersArr = $this->model->getFilteredPlayers($sort_filter, $sort_mode);
            }
            return $this->view->response($playersArr, 200);
            
    }
    private function validateOrder($sort_filter, $sort_mode)
    {
        return ($sort_filter == "nacionalidad") && ($sort_mode == "ASC" || $sort_mode == "DESC");
    }
    public function getPlayerById($params = []){

        if (!isset($params[':id']) || empty($params[':id'])) {
            return $this->view->response("id erroneo.", 400);
        } else {
            $id = $params[':id'];
            $player = $this->model->getPlayerById($id);
            //pregunto si existe producto con ese id.
            if (!$player) {
                $this->view->response('Jugador no encontrado', 404);
            } else {
                $this->view->response($player, 200);
            }
        }
    }

    public function deletePlayerById($params = []){

        if (!isset($params[':id']) || empty($params[':id'])) {
            return $this->view->response("id erroneo.", 400);
        } else {
            $id = $params[':id'];
            $player = $this->model->getPlayerById($id);
            //pregunto si existe producto con ese id.
            if (!$player) {
                $this->view->response('Jugador no encontrado', 404);
            } else {
                $this->model->deletePlayerById($id);
                $this->view->response("jugador eliminado", 200);
            }
        }
    }
    function getData()
    {
        return json_decode($this->data);
    }

    function createPlayer()
    {
        $jugador = $this->getData();
        $nombre = $jugador->nombre;
        $posicion = $jugador->posicion;
        $pie_habil = $jugador->pie_habil;
        $nacionalidad = $jugador->nacionalidad;
        $id_equipo = $jugador->id_equipo;
        //validamos JSON
        if (!$this->validateJSON($id_equipo, $nombre, $posicion, $pie_habil, $nacionalidad)) {
            $this->view->response('Jugador no ingresado correctamente', 400);
        } else {
            //si esta repetido
            if ($this->model->getPlayerByName($nombre)) {
                $this->view->response('Este jugador ya existe', 400);
            } else {
                //agrego un jugador
               $JugadorId = $this->model->insertPlayer($id_equipo, $nombre, $posicion, $pie_habil, $nacionalidad);
                //vemos si el producto esta en la base de datos
                $jugador = $this->model->getPlayerById($JugadorId);

                if (!$jugador) {
                    return $this->view->response("No pudimos agregar el jugador.", 500);
                } else {
                    $this->view->response('Se agrego jugador correctamente ' . $JugadorId, 201);
                }
            }
        }
    }

    function validateJSON($id_equipo, $nombre, $posicion, $pie_habil, $nacionalidad){
        if  (!isset($id_equipo) || !isset($nombre) || !isset($posicion) || !isset($pie_habil) || !isset($nacionalidad) || 
            empty($id_equipo) || empty($nombre) || empty($posicion) || empty($pie_habil) || empty($nacionalidad)){
            return false;
        } else {
                return true;
            }
    }

    function updatePlayerById($params = []){
        //compruebo que paso el :ID
        if (!isset($params[':id']) || empty($params[':id'])) {
            return $this->view->response("no podemos identificar el jugador sin un id", 400);
        }

        //compruebo q existe el producto
        $JugadorId = $params[':id'];
        $playerExisting = $this->model->getPlayerById($JugadorId);
        if (!$playerExisting) {
            $this->view->response("no encontramos el jugador", 404);
        } else {
            $jugador = $this->getData();
            $nombre = $jugador->nombre;
            $posicion = $jugador->posicion;
            $pie_habil = $jugador->pie_habil;
            $nacionalidad = $jugador->nacionalidad;
            $id_equipo = $jugador->id_equipo;
            //validamos JSON
            if (!$this->validateJSON($id_equipo , $nombre, $posicion, $pie_habil, $nacionalidad)) {
                $this->view->response('Jugador no ingresado correctamente', 400);
            } else {
                //haces la validacion del json
                $this->model->updatePlayer($id_equipo, $nombre, $posicion, $pie_habil, $nacionalidad,  $JugadorId);
                $this->view->response('El jugador ' . $JugadorId . ' fue modificado correctamente ', 200);
                //envias los datos al update
            }
        }
    }

}

    

