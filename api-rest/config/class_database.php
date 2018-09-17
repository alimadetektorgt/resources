<?php
/**
 * Esta clase configura la conexion a la base datos 
 *
 * @package    config
 * @author     Alexander L. Lima <https://github.com/alimadetektorgt/>
 * @version    Release: 1.0.0
 */
class Database {
    
    //especifica tus propias credenciales de base de datos
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "postgres";
    private $password = "";
 
    /**
     * Obtener la conexión a la base de datos
     *
     * @param null
     *
     * @return connection
     */
    public function getConnection(){
        $connection = null;

        try {
            $connection = @pg_connect("host=".$this->host." port=5432 dbname=".$this->db_name." user=".$this->username." password=".$this->password);            
        } catch (Exception $exception) {
            return "Error en la conexion: " . $exception->getMessage();
        }
 
        return $connection;
    }


    /**
     * Ejecuta una consulta en la base de datos
     *
     * @param query:string
     *
     * @return array
     */
    public function executeQuery($query = ''){

        $connection = $this->getConnection();

        $result = pg_query($connection, $query);
        if (!$result){
            return false;
        } else {
            return true;
        }
    }

    /**
     * Ejecuta una consulta en la base de datos
     *
     * @param query:string
     *
     * @return array
     */
    public function searchQuery($query = ''){

        $connection = $this->getConnection();

        $result = pg_query($connection, $query);

        $data = array();
        while($tmp = pg_fetch_assoc($result)){
            $data[] = $tmp;
        }

        return $data;
    }
}
?>