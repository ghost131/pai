<?php

namespace Repository;

class RepositoryFactory {

    public static function getRepository($repositoryName = null) {
        $class = "Repository\\".ucfirst($repositoryName);

        if ($repositoryName && class_exists($class)) {
           return new $class();

        }

        throw new \Exception("Repozytorium o nazwie \"$class\" nie istnieje");
    }
}