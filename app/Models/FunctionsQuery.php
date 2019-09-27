<?php

namespace Vital\Models;

class FunctionsQuery extends Conn
{
    private $log;
    protected $campo;
    protected $parametro;
    protected $bindParam;
    protected $sql_insert;
    protected $sql_update;
    protected $sql_delete;


    public function consulta($table, $where = '')
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $table $where");
            $stmt->execute();
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            return ['erro'=>$e->getMessage()];
        }
    }

    public function gravar($table, $campos)
    {
        $result = $this->consulta($table, "where email = '".$campos['EMAIL']."'");
        if ($result == 0) {
            $this->insert($table, $campos);
        } else {
            $this->update($table, $campos,$result[0]['id']);
        }
    }

    public function insert($table, $campos)
    {
        try {
            foreach($campos as $indice => $valor)
            {
                $this->campo .= $indice.', ';
                $this->parametro .= ':'.$indice.', ';
            }
            $this->campo = rtrim($this->campo, ', ') ;
            $this->parametro = rtrim($this->parametro, ', ') ;
            $this->sql_insert = "INSERT INTO ".$table." ($this->campo) VALUES ($this->parametro)";
            $stmt = $this->conn->prepare("$this->sql_insert");
            foreach($campos as $indice => $valor) {
                $stmt->bindValue($indice,$valor);
            }
            if($stmt->execute() === false){
                echo "<pre>";
                print_r($stmt->errorInfo());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            // TO DO
        }
    }

    public function update($table, $campos, $id)
    {

        try {
            foreach($campos as $indice => $valor)
            {
                $this->campo .= $indice.' = '.':'.$indice.', ';
                $this->parametro .= ':'.$indice.', ';
            }
            $this->campo = rtrim($this->campo, ', ');
            $this->sql_update = "UPDATE $table SET " . $this->campo . " WHERE ID = " . $id;
            $stmt = $this->conn->prepare("$this->sql_update");
            foreach ($campos as $indice => $valor) {
                $stmt->bindValue($indice, $valor);
            }
            if ($stmt->execute() === false) {
                print_r($stmt->errorInfo());
            } else {
                print_r('Atualizado com Sucesso');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            // TO DO
        }
    }

    public function delete ($table, $campo, $id)
    {
        $this->sql_delete = "DELETE FROM $table WHERE $campo = $id";
        $stmt = $this->conn->prepare("$this->sql_delete");
        if($stmt->execute() === false){
            print_r($stmt->errorInfo());
        } else {
            print_r('Excluido com Sucesso');
        }
    }
}