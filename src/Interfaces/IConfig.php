<?php


namespace App\Interfaces;


interface IConfig extends \ArrayAccess {
    public function __construct(array $data = []);

    public function load(string $file);
}