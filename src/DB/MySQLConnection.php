<?php

namespace App\DB;

use App\Interfaces\IDBConfig;
use App\Interfaces\IDBConnection;

class MySQLConnection implements IDBConnection {
    private $dbo;

    /**
     * MySQLConnection constructor.
     * @param IDBConfig $config
     * @throws \Exception
     */
    public function __construct(IDBConfig $config) {
        $dsn = sprintf('%s:dbname=%s;host=%s',
            $config->getDriver(),
            $config->getDBName(),
            $config->getHost()
        );

        try {
            $this->dbo = new \PDO($dsn, $config->getUser(), $config->getPassword());
        } catch (\PDOException $e) {
            throw new \Exception("Failed to connect {$dsn}: [{$e->getCode()}] {$e->getMessage()}");
        }
    }

    /**
     * @return \PDO
     * @throws \Exception
     */
    public function getDBObject(): \PDO {
        return $this->dbo;
    }
}