<?php

namespace App\Interfaces;

interface IDBConnection {
    public function __construct(IDBConfig $config);

    public function getDBObject(): \PDO;
}