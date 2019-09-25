<?php

namespace App\DB;

use App\Config;
use App\Interfaces\IDBConfig;

class MySQLConfig extends Config implements IDBConfig {
    public function getDriver(): string {
        return 'mysql';
    }

    public function getHost(): string {
        return $this['CONNECTION']['host'];
    }

    public function getDBName(): string {
        return $this['CONNECTION']['dbname'];
    }

    public function getUser(): string {
        return $this['CONNECTION']['user'];
    }

    public function getPassword(): string {
        return $this['CONNECTION']['password'];
    }
}