<?php


namespace App\Interfaces;


interface IDBEntity {
    public function update(IDBManager $manager);

    public function insert(IDBManager $manager);
}