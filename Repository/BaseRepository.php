<?php

namespace Repository;

use PDO;
use PDOException;

class BaseRepository
{

    protected $pdo;
    private $tableName;
    protected $entityClass;

    public function __construct($entityClass, $tableName)
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=pcichon;charset=utf8', 'root', '');
        } catch (PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }

        $this->entityClass = $entityClass;
        $this->tableName = $tableName;
    }

    public function findAll()
    {
        $statement = $this->pdo->query("SELECT * FROM $this->tableName");
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);
        return $statement->fetchAll();
    }

    public function findOneBy($fields)
    {
        $query = "SELECT * FROM $this->tableName WHERE ";

        foreach ($fields as $key => $value) {

            $query .= is_string($value) ? "$key='$value'" : "$key=$value";
        }

        $query .= " LIMIT 1";

        $statement = $this->pdo->query($query);

        $statement->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);
        return $statement->fetch();
    }

}