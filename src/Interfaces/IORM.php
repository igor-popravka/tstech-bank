<?php

namespace App\Interfaces;

interface IORM {
    public function setConnection(IDBConnection $connection);

    public function getConnection(): IDBConnection;

    public function query(string $statement, array $bind = []): array;

    public function fetchAll(string $entity_class): array;
}