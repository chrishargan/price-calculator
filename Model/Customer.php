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
    private int $fixDiscount;
    private int $varDiscount;
    private Group $group;

    public function __construct(int $id, string $firstName, string $lastName, int $fixDiscount, int $varDiscount, Group $group)
        //nest Group data in Customer
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
        $this->group = $group;
    }

    public function getId()
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

    public function getFixDiscount(): int
    {
        return $this->fixDiscount;
    }

    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function variableDiscountArray($group, $arrayVar = []) : array {
        $arrayVar[] = $group->getVarDiscount();
        if($group->getGroup() !== null) {
            $arrayVar = $this->variableDiscountArray($group->getGroup(), $arrayVar);
        }
        return $arrayVar;
    }

    public function fixedDiscountArray($group, $arrayFix = []) {
        $arrayFix[] = $group->getFixDiscount();
        if($group->getGroup() !== null) {
            $arrayFix = $this->fixedDiscountArray($group->getGroup(), $arrayFix);
        }
        return $arrayFix;
    }

    public function calculatePrice(Product $product) : float {
        $fixed = array_sum($this->fixedDiscountArray($this->group))*100;
        $max = max($this->variableDiscountArray($this->group));
        $price = $product->getPrice();
        $variable = (($price/100) * $max);
        if ($variable > $fixed) {
            $result = $variable;
        } else {
            $result = $fixed;
        }
        return $result;
    }
}