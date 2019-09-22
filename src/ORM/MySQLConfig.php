<?php

namespace App\ORM;

use App\Config;
use App\Interfaces\IDBConfig;

class MySQLConfig extends Config implements IDBConfig {
    public function getDriver(): string {
        return 'mysql';
    }

    public function getHost(): string {
        return $this['host'];
    }

    public function getDBName(): string {
        return $this['dbname'];
    }

    public function getUser(): string {
        return $this['user'];
    }

    public function getPassword(): string {
        return $this['password'];
    }
}