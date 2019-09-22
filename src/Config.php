<?php


namespace App;


abstract class Config implements \ArrayAccess {
    private $data;

    public function __construct(array $data = []) {
        $this->setData($data);
    }

    public function loadFromFile(string $file) {
        $data = parse_ini_file($file, true);
        $this->setData($data !== false ? $data : []);
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