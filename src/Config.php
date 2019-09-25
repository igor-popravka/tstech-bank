<?php


namespace App;


use App\Interfaces\IConfig;

abstract class Config implements IConfig {
    private $data;

    public function __construct(array $data = []) {
        $this->setData($data);
    }

    public function load(string $file) {
        $data = parse_ini_file($file, true);
        $this->setData($data !== false ? $data : []);
        return $this;
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    protected function setData(array $data) {
        $this->data = $data;
    }
}