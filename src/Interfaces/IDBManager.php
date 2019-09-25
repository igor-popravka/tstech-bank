<?php

namespace App\Interfaces;

interface IDBManager {
    public function __construct(IDBConnection $connection);

    public function query(string $statement, array $bind = null): \PDOStatement;

    public function find(string $statement, array $bind = null, string $extract_entity = null): array;
}