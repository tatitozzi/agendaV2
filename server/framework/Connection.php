<?php
return new class {
    private $pdo;

    function __construct() {       
        $this->pdo = new PDO(
            "mysql:host=localhost;dbname=agenda", 
            "root", 
            "",
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING    
            ]
        );
    }

    function select() {
        $sth = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $sth->execute(["id"=>1]);
        $result = $sth->fetchAll();
        print_r($result);
    }

    function insert($table, $data) {
        $columnNames = implode(", ", array_keys($data));
        $columnValuesRef = ":" . implode(", :", array_keys($data));
        $sth = $this->pdo->prepare("INSERT INTO $table($columnNames) VALUES($columnValuesRef)");
        $sth->execute($data);
        return $this->pdo->lastInsertId();
    }
};