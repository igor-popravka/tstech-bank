<?php

namespace App\DB;

use App\Interfaces\IDBConnection;
use App\Interfaces\IDBManager;

class MySQLManager implements IDBManager {
    private $connection;

    public function __construct(IDBConnection $connection) {
        $this->connection = $connection;
    }

    protected function getConnection(): IDBConnection {
        return $this->connection;
    }

    /**
     * @param string $statement
     * @param array|null $bind
     * @return \PDOStatement
     */
    public function query(string $statement, array $bind = null): \PDOStatement {
        $dbo = $this->getConnection()->getDBObject();

        $sto = $dbo->prepare($statement);

        $sto->execute($bind);

        return $sto;
    }

    public function find(string $statement, array $bind = null, string $extract_entity = null): array {
        $sto = $this->query($statement, $bind);

        if ($extract_entity) {
            return array_map(function ($row) use ($extract_entity) {
                return new $extract_entity($row);
            }, $sto->fetchAll());
        }

        return $sto->fetchAll(\PDO::FETCH_ASSOC);
    }
}