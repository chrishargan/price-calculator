<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private int $group_id;
    private int $fixDiscount;
    private int $varDiscount;

    public function __construct(int $id, string $firstName, string $lastName, int $group_id, int $fixDiscount, int $varDiscount)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->group_id = $group_id;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function getFixDiscount(): int
    {
        return $this->fixDiscount;
    }

    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }


}