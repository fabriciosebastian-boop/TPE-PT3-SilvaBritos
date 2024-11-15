<?php   

class EquiposModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=ligas;charset=utf8', 'root', '');
    }
 
    public function getEquipos() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM equipo');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $equipo = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $equipo;
    }
 
    public function getEquipoById($id) {    
        $query = $this->db->prepare('SELECT * FROM equipo WHERE id_equipo = ?');
        $query->execute([$id]);   
    
        $equipo = $query->fetch(PDO::FETCH_OBJ);
    
        return $equipo;
    }
 
    public function insertEquipo($nombre, $puntos, $pj, $pg, $pe, $pp) { 
        $query = $this->db->prepare('INSERT INTO equipo(nombre, puntos, pj, pg, pe, pp) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$nombre, $puntos, $pj, $pg, $pe, $pp]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseEquipo($id) {
        $query = $this->db->prepare('DELETE FROM equipo WHERE id_equipo = ?');
        $query->execute([$id]);
    }

    public function updateEquipo($id_equipo, $nombre, $puntos, $pj, $pg, $pe, $pp) {
            
        $query = $this->db->prepare('UPDATE equipo SET  nombre = ? , puntos = ? , pj = ? , pg = ? , pe = ? , pp = ? WHERE id_equipo = ?');
        $query->execute([$nombre, $puntos, $pj, $pg, $pe, $pp, $id_equipo]);
    }
    

}

    
