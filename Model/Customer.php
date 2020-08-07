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

    public function getCustomer(): string
    {
        return $this->firstName . " " . $this->lastName;
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



// Creates array of all group related Variable discounts
    public function arrayOfVariableDiscounts(Group $group, $array = []): array
    {
        $array[] = $group->getVarDiscount();

        if ($group->getGroup() !== null) {
            $group = $group->getGroup();
            $array = $this->arrayOfVariableDiscounts($group, $array);
        }
        return $array;

    }

// returns the variable discount of the highest percentage
    public function optimalVarDiscount()
    {

        return max($this->arrayOfVariableDiscounts($this->getGroup()));
    }

// returns in cents the value of the highest variable discount of the product
    public function finalVariableDiscount(Product $product)
    {
        $max = $this->optimalVarDiscount();
        return ($product->getPrice() / 100) * $max;
    }

// creates an array of all associated fixed discounts
    public function arrayOfFixedDiscounts(Group $group, $array = []): array
    {
        $array[] = $group->getFixDiscount();
        if ($group->getGroup() !== null) {
            $group = $group->getGroup();
            $array = $this->arrayOfFixedDiscounts($group, $array);
        }
        return $array;
    }

// returns the summation of all the available group fixed discounts
    public function sumFixedDiscount()
    {
        return array_sum($this->arrayOfFixedDiscounts($this->getGroup())) * 100;
    }

// Calculates price using either the best variable or fixed discounts in cents and prevents cost being less than 0
    public function calculatePrice(Product $product) :float
    {
        $variable = $this->finalVariableDiscount($product);
        $fixed = $this->sumFixedDiscount();
        $price = $product->getPrice();

        $variable > $fixed ? $resultGroupVar = $variable : $resultGroupFix = $fixed;
        //compare the result with the customer discount
        $varCustomer = ($price/100) * $this->getVarDiscount();
        $fixCustomer = $this->getFixDiscount()*100;
        if (isset($resultGroupFix)) {
            if ($fixCustomer !== 0) {
                $price = $price - $resultGroupFix - $fixCustomer;
            } else {
                $price -= $resultGroupFix;
                $price *= $this->getVarDiscount() / 100;
            }
        } elseif (isset($resultGroupVar)) {
            if ($fixCustomer !== 0) {
                $price -= $fixCustomer;
                $price *= $this->optimalVarDiscount() / 100;

            } else {
                $price -= max($resultGroupVar, $varCustomer);
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


/*
        if ($VariableAsFixed > $fixed) {

            $endPrice = $price - $VariableAsFixed;
            if ($endPrice < 0) {
                $endPrice = 0;
                return $endPrice;
            } else {
                return $endPrice /100;
            }

        } elseif ($fixed > $VariableAsFixed) {
            $endPrice = $price - $fixed;
            if ($endPrice < 0) {
                $endPrice = 0;
                return $endPrice;
            } else {
                return $endPrice/100;
            }*/


}


