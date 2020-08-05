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

    public function __construct(int $id, string $groupName, int $fixDiscount, int $varDiscount, int $parent_id)
    {
        $this->id = $id;
        $this->groupName = $groupName;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
        $this->parent_id = $parent_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getParentId(): int
    {
        return $this->parentId;
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

    public function getParentGroup() : array {

    }
}