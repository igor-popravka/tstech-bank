<?php

namespace App\Interfaces;


interface IDBConfig {
    public function getDriver(): string;
    public function getHost(): string;
    public function getDBName(): string;
    public function getUser(): string;
    public function getPassword(): string;
}