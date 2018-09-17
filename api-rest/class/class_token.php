<?php
/**
 * Esta clase administra los token
 *
 * @package    class
 * @author     Alexander L. Lima <https://github.com/alimadetektorgt/>
 * @version    Release: 1.0.0
 */
class Token {
    private $database;

    public function __construct() {
        $this->database     = new Database();
    }
    
    /**
     * Obtener la informacion del token
     *
     * @param token_id:number
     *
     * @return array
     */
    public function getToken($token_id = 0){

        if ($token_id > 0) {
            //Buscar token por id
            $query = "SELECT * FROM api_token WHERE id = '{$token_id}'";
            return $this->database->searchQuery($query);
        } else {
            //Consultar todos los token
            $query = "SELECT * FROM api_token ORDER BY id DESC";
            return $this->database->searchQuery($query);
        }

    }

    /**
     * Crear o editar un token
     *
     * @param token_id:number
     *
     * @return array
     */
    public function adminToken($token_id = 0){

        if ($token_id > 0) {
            //Editar elemento
            $query = "UPDATE api_token SET ". $_GET['field'] ." = ". $_GET['value'] ." WHERE id = ".$token_id;            
        } else {
            //Crear elemento
            $hash = null;
            $qtd = 10;
            $op = "ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789";
            $ca = strlen($op);
            $status = 'true';

            for($x = 1; $x <= $qtd; $x++){
                $pos = rand(0, $ca); 
                $hash .= substr($op, $pos, 1);
            }

            $query = "INSERT INTO api_token (token, status) VALUES ('{$hash}', '{$status}')";
        }

        $rTMP = $this->database->executeQuery($query);
        if ($rTMP === false) {
            return array("result"=>"fail","descripcion"=>"Se ha producido un error.");
        } else {
            return array("result"=>"success","descripcion"=>"Se realizado la accion exitosamente.");
        }

    }

    /**
     * Elimina un token de la base de datos
     *
     * @param token_id:number
     *
     * @return array
     */
    public function deleteToken($token_id = 0){

        if ($token_id > 0) {
            //Eliminar token por id
            $query = "DELETE FROM api_token WHERE id = '{$token_id}'";
        } else {
            //Eliminar todos los token (IMPORTANTE: No se recomienda habilitar esta opcion)
            $query = "DELETE FROM api_token";
        }

        $rTMP = $this->database->executeQuery($query);
        if ($rTMP === false) {
            return array("result"=>"fail","descripcion"=>"Se ha producido un error.");
        } else {
            return array("result"=>"success","descripcion"=>"Se realizado la accion exitosamente.");
        }        

    }
}
?>