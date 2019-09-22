<?php

namespace App\ORM;

use App\Interfaces\IDBConnection;
use App\Interfaces\IORM;

class ORM implements IORM {
    private $connection;

    public function setConnection(IDBConnection $connection) {
        $this->connection = $connection;
    }

    public function getConnection(): IDBConnection {
        return $this->connection;
    }

    public function query(string $statement, array $bind = []): array {
        $dbh = $this->getConnection()->getPDO();

        $sth = $dbh->prepare($statement);
        $sth->execute($bind);

        return $sth->fetchAll();
    }

    public function fetchAll(string $entity_class): array {
        /** @var MySQLEntity $entity */
        $entity = new $entity_class;
        $statement = "SELECT * FROM {$entity->getTable()};";
        $result = $this->query($statement);

        $result = array_map(function ($row) use ($entity) {
            return (clone $entity)->fromArray($row);
        }, $result);

        return $result;
    }
}