<?php

namespace JCN\DataBase;

class Conexao {
    private $str_connect;
    private $conn;
    private $srv;
    private $user;
    private $pass;

    public function __construct($host, $port, $database, $user, $pass)
    {
        //$this->str_connect = $str_connect;
        $this->srv ="pgsql: host=$host; port=$port; dbname=$database";
        $this->user = $user;
        $this->pass = $pass;
        //connect($dns, $user, $pass)
    }

    public function connect()
    {
        try {
            $this->conn = new \PDO($this->srv,$this->user, $this->pass);
            //echo "Conexao Realizada com sucesso";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->conn;
    }
    public function disconnect()
    {
        $this->conn = null;
    }
}
//$host = "sqlite:database.sqlite";
//$db = new Conexao('sqlite:database.sqlite');
//$db->connect();