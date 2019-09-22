<?php


namespace App\Interfaces;


interface IEntity {
    public function update(IORM $orm);
    public function insert(IORM $orm);
}