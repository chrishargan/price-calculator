<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Group
{
    private int $id;
    private string $groupName;
    private int $fixDiscount;
    private int $varDiscount;
    private int $parent_id;
    private ?Group $group; //check if Group exists

    public function __construct(int $id, string $groupName, int $fixDiscount, int $varDiscount, int $parent_id, GroupLoader $groupLoader)
        //pass GroupLoader in the Group for nesting parents of the group
    {
        $this->id = $id;
        $this->groupName = $groupName;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
        $this->parent_id = $parent_id;
        //check if parent_id is not 0, if so it is the parent, otherwise get the group with the parent_id
        $groups = $groupLoader->getGroups();
        $this->group = ($parent_id !== 0) ? $groups[$parent_id] : null;
     //   $this->updateDiscount();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }

    public function getFixDiscount(): int
    {
        return $this->fixDiscount;
    }


    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }

    public function getParentId(): int
    {
        return $this->parent_id;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function updateDiscount() {
        $databaseQuery = new DatabaseLoader();
        $databaseQuery->openConnection();
        $statement = $databaseQuery->prepare('SELECT parent_id, fixed_discount, variable_discount from customer_group where id = :parent_id');
        $statement->bindValue('parent_id', $this->getParentId());
        $statement->execute();
        $newDiscountsArray = $statement->fetch();

        if ($newDiscountsArray['fixed_discount']) {
            $this->fixDiscount += intval($newDiscountsArray['fixed_discount']);
        } elseif ($newDiscountsArray['variable_discount'] > $this->getVarDiscount())
        {
            $this->varDiscount = intval($newDiscountsArray['variable_discount']);
        }
        if ($newDiscountsArray['parent_id'])
        {
            $this->parentId = $newDiscountsArray['parent_id'];
            $this->updateDiscount();
        }

   }
}