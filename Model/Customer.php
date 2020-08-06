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

    public function getNestedGroups(): Group
    {
        return $this->group . $this->group . $this->group;
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

    public function calculateFixDiscount()
    {
        if ($this->group->getFixDiscount() !== 0) {
            $this->discounts[] += $this->group->getFixDiscount();
        } else
            $this->discounts += 0;
        $subGroup = $this->group->getGroup();
        if ($subGroup->getFixDiscount() !== 0) {
            $this->discounts[] += $subGroup->getFixDiscount();
        } else {
            $this->discounts += 0;
        }
    }


    public function arrayOfVariableDiscounts(Group $group, $array = []): array
    {
        $array[] = $group->getVarDiscount();

        if ($group->getGroup() !== null) {
            $group = $group->getGroup();
            $array = $this->arrayOfVariableDiscounts($group, $array);
        }
        return $array;

    }

    public function optimalVarDiscount()
    {
        return max($this->arrayOfVariableDiscounts($this->getGroup()));
    }
/*
    public function finalVariableDiscount(Product $product){
        $max = $this->optimalVarDiscount();
        return   ($product->getPrice()/100) * $max;
    }*/


    public function arrayOfFixedDiscounts(Group $group, $array = []): array
    {
        $array[] = $group->getFixDiscount();
        if ($group->getGroup() !== null) {
            $group = $group->getGroup();
            $array = $this->arrayOfFixedDiscounts($group, $array);
        }
        return $array;
    }

    public function sumFixedDiscount()
    {
     return array_sum($this->arrayOfFixedDiscounts($this->getGroup())) * 100;
    }

    public function calculatePrice(Product $product) {
        $variable =$this->optimalVarDiscount();
        $fixed = $this->sumFixedDiscount();

        if( $variable > $fixed ) {

           $product->getPrice() - $variable;
        }

    }
}





/*class CustomerGroup extends Customer
{

    public array $groupId;
    private int $parentId;
    private int $fixedDiscount;
    private int $variableDiscount;
    private array $discounts;

    public function __construct(Customer $customer)
    {
        $customerGroupId = $customer->getGroup();
        $database = new DatabaseLoader();
        $database->openConnection();
        $pdo = $database->getPdo();
        $statement = $pdo->prepare('SELECT parent_id, fixed_disocunt,variable_discount from customer_group where id =:id');
        $statement->bindValue('id', $customerGroupId);
        $statement->execute();
        $totalArray = $statement->fetch();
        $this->parentId = intval($totalArray['parent_id']);
        $this->discounts['fixed'] = intval($totalArray['fixed_discount']);
        $this->discounts['variable'] = intval($totalArray['variable_discount']);
        $this->setDiscounts();

    }
 private function setDiscounts()  : void {
   $database= new DatabaseLoader();
   $database->openConnection();

   $parentId = $this->getParentId();
   $statement = $pdo->
   $statement = ($parent['fixed_discount'])


 }
}
*/

