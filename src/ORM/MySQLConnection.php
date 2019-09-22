<?php

namespace App\ORM;

use App\Interfaces\IDBConfig;
use App\Interfaces\IDBConnection;

class MySQLConnection implements IDBConnection {
    private $config;

    public function __construct(IDBConfig $config) {
        $this->config = $config;
    }

    /**
     * @return \PDO
     * @throws \Exception
     */
    public function getPDO(): \PDO {
        $dsn = sprintf('%s:dbname=%s;host=%s',
            $this->config->getDriver(),
            $this->config->getDBName(),
            $this->config->getHost()
        );

        try {
            $pdo = new \PDO($dsn, $this->config->getUser(), $this->config->getPassword());
        } catch (\PDOException $e) {
            throw new \Exception("Failed to connect {$dsn}: [{$e->getCode()}] {$e->getMessage()}");
        }

        return $pdo;
    }
}