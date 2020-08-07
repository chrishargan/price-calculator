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

    //make array of variable discounts of the groups with recursive function to get data out of tree
    public function variableDiscountArray($group, $arrayVar = []) : array {
        $arrayVar[] = $group->getVarDiscount();
        if($group->getGroup() !== null) {
            $arrayVar = $this->variableDiscountArray($group->getGroup(), $arrayVar);
        }
        return $arrayVar;
    }

    //make array of fixed discounts of the groups with recursive function to get data out of tree
    public function fixedDiscountArray($group, $arrayFix = []) {
        $arrayFix[] = $group->getFixDiscount();
        if($group->getGroup() !== null) {
            $arrayFix = $this->fixedDiscountArray($group->getGroup(), $arrayFix);
        }
        return $arrayFix;
    }

    //calculate highest discount of the groups
    public function calculatePrice(Product $product) : float {
        $price = $product->getPrice();
        //fixed discounts get added up
        $fixGroup = array_sum($this->fixedDiscountArray($this->getGroup()))*100;
        //get biggest variable discount
        $varGroup = (($price/100) * max($this->variableDiscountArray($this->getGroup())));
        //check if fixed discount or variable discount of the group is bigger
        $varGroup > $fixGroup ? $resultGroupVar = $varGroup : $resultGroupFix = $fixGroup;
        //compare the result with the customer discount
        $varCustomer = ($price/100) * $this->getVarDiscount();
        $fixCustomer = $this->getFixDiscount()*100;
        if (isset($resultGroupFix)) {
            if ($fixCustomer !== null) {
                $price = $price - $resultGroupFix - $fixCustomer;
            } elseif ($resultGroupFix > $varCustomer) {
                $price -= $resultGroupFix;
            } else {
                $price -= $varCustomer;
            }
        } elseif (isset($resultGroupVar)) {
            if ($varCustomer !== null) {
                $price -= max($resultGroupVar, $varCustomer);
            } elseif ($fixCustomer > $resultGroupVar) {
                $price -= $fixCustomer;
            } else {
                $price -= $resultGroupVar;
            }
        }
        //price with 2 decimals
        $price = round($price/100, 2);
        //price cannot be lower than 0
        if ($price < 0) {
            $price = 0;
        }
        return $price;
    }
}