<?php
namespace Vital\Models;

class Conn
{
    private $dns = "mysql:dbname=desafio_vitto_bd; host=localhost";
    private $user = "root";
    private $pass = "123456";
    protected $conn;

    public function __construct()
    {
        if(!$this->conn){
            try {
                $this->conn = new \PDO($this->dns,$this->user, $this->pass);
            } catch (PDOException $e) {
                echo "Erro: <code> ".$e->getMessage(). "</code>";
            }
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

}