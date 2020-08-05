<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Group
{
    private int $id;
    private int $parentId;
    private string $groupName;
    private int $fixDiscount;
    private int $varDiscount;

    public function __construct(int $id, int $parentId, string $groupName, int $fixDiscount, int $varDiscount)
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->groupName = $groupName;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
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
}