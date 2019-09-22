<?php


namespace App\Entities;


use App\ORM\MySQLEntity;

class Deposit extends MySQLEntity {
    /** @var integer */
    private $id;
    /** @var integer */
    private $client_id;
    /** @var string */
    private $name;
    /** @var string */
    private $account;
    /** @var float */
    private $equity;
    /** @var \DateTime */
    private $ts;

    /**
     * @return int
     */
    public function getClientId(): int {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     */
    public function setClientId(int $client_id): void {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAccount(): string {
        return $this->account;
    }

    /**
     * @param string $account
     */
    public function setAccount(string $account): void {
        $this->account = $account;
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
    public function setEquity(float $equity): void {
        $this->equity = $equity;
    }

    /**cls
     * @return \DateTime
     */
    public function getTs(): ?\DateTime {
        return $this->ts;
    }

    /**
     * @param \DateTime $ts
     */
    public function setTs(?\DateTime $ts): void {
        $this->ts = $ts;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    public function getTable(): string {
        return 'deposits';
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'client_id' => $this->getClientId(),
            'name' => $this->getName(),
            'account' => $this->getAccount(),
            'equity' => $this->getEquity(),
            'ts' => $this->getTs(),
        ];
    }
}