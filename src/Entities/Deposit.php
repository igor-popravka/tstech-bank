<?php


namespace App\Entities;


use App\Interfaces\IEntity;
use App\ORM\MySQLEntity;

class Deposit extends MySQLEntity {
    const TABLE_NAME = 'deposit';

    /**
     * @var integer
     */
    private $id_deposit;
    /**
     * @var integer
     */
    private $id_client;
    /**
     * @var string
     */
    private $account_number;
    /**
     * @var float
     */
    private $equity;
    /**
     * @var \DateTime
     */
    private $open_date;

    public function updateStatement(): string {
        return "UPDATE deposit SET equity = {$this->getEquity()};";
    }

    public function insertStatement(): string {
        return 'SELECT';
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->getIdDeposit();
    }

    public function getTable(): string {
        return self::TABLE_NAME;
    }

    public function toArray(): array {
        return [
            'id_deposit' => $this->getIdDeposit(),
            'client_id' => $this->getIdClient(),
            'account_number' => $this->getAccountNumber(),
            'equity' => $this->getEquity(),
            'ts' => $this->getOpenDate()->format(self::DB_DATE_FORMAT),
        ];
    }

    /**
     * @return int
     */
    public function getIdDeposit(): int {
        return $this->id_deposit;
    }

    /**
     * @param int $id_deposit
     */
    public function setIdDeposit(int $id_deposit) {
        $this->id_deposit = $id_deposit;
    }

    /**
     * @return int
     */
    public function getIdClient(): int {
        return $this->id_client;
    }

    /**
     * @param int $id_client
     */
    public function setIdClient(int $id_client) {
        $this->id_client = $id_client;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     */
    public function setAccountNumber(string $account_number) {
        $this->account_number = $account_number;
    }

    /**
     * @return float
     */
    public function getEquity(): float {
        return $this->equity;
    }

    /**
     * @param float $equity
     */
    public function setEquity(float $equity) {
        $this->equity = $equity;
    }

    /**
     * @return \DateTime
     */
    public function getOpenDate(): \DateTime {
        return $this->open_date ?? new \DateTime();
    }

    /**
     * @param string $open_date
     */
    public function setOpenDate(string $open_date) {
        $this->open_date = \DateTime::createFromFormat(self::DB_DATE_FORMAT, $open_date);
    }
}