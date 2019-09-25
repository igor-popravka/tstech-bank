<?php


namespace App\DB;


use App\Interfaces\IDBEntity;
use App\Interfaces\IDBManager;

abstract class MySQLEntity implements IDBEntity {
    const DB_DATE_FORMAT = 'Y-m-d';

    public function __construct(array $row = []) {
        $this->fromArray($row);
    }

    public function fromArray(array $row): MySQLEntity {
        foreach ($this->generateSetters($row) as $setter => $value) {
            if (method_exists($this, $setter)) {
                call_user_func([$this, $setter], $value);
            }
        }

        return $this;
    }

    private function generateSetters(array $data) {
        foreach ($data as $col => $val) {
            if (strpos($col, "_") !== false) {
                $parts = explode('_', $col);
                $parts = array_map(function ($part) {
                    return ucfirst($part);
                }, $parts);

                yield ('set' . implode('', $parts)) => $val;
            } else {
                yield ('set' . ucfirst($col)) => $val;
            }
        }
    }
}