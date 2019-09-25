<?php


namespace App\Interfaces;


interface IEntity {
    const DB_DATE_FORMAT = 'Y-m-d';

    public function update(IORM $orm);

    public function insert(IORM $orm);

    public function updateStatement(): string;

    public function insertStatement(): string;
}