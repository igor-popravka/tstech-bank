<?php


namespace App\ORM;


use App\Interfaces\IEntity;
use App\Interfaces\IORM;

abstract class MySQLEntity implements IEntity {
    abstract public function getId(): int;

    abstract public function getTable(): string;

    abstract public function toArray(): array;

    public function update(IORM $orm) {
        $statement = "UPDATE {$this->getTable()} SET ";
        foreach ($this->generateUpdate('id') as $set) {
            $statement .= $set;
        }
        $statement .= "WHERE id={$this->getId()};";

        $orm->query($statement);
    }

    public function insert(IORM $orm) {
        $inserts = array_filter($this->toArray(), function ($key) {
            return !in_array($key, ['id']);
        }, ARRAY_FILTER_USE_KEY);

        $columns = array_keys($inserts);
        $bind_keys = array_map(function ($col) {
            return ':' . $col;
        }, $columns);

        $statement = sprintf("INSERT INTO {$this->getTable()} (%s) VALUES (%s);",
            implode(', ', $columns),
            implode(', ', $bind_keys)
        );

        $bind = array_combine($bind_keys, array_values($inserts));
        $orm->query($statement, $bind);
    }

    private function generateUpdate(...$exclude) {
        $array = $this->toArray();

        foreach ($array as $col => $val) {
            if (in_array($col, $exclude)) continue;

            if ($val == end($array)) {
                yield "{$col} = {$val} ";
            } else {
                yield "{$col} = {$val}, ";
            }
        }
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