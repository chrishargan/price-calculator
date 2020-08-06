<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  GroupLoader extends DatabaseLoader
{
    private array $groups = [];

    public function __construct()
    {
        if (empty($this->groups)) {
            $pdo = $this->openConnection();
            $getGroup = $pdo->prepare('SELECT * FROM customer_group');
            $getGroup->execute();
            $groups = $getGroup->fetchAll();
            foreach ($groups as $group) {
                $this->groups[$group['id']] = new Group((int)$group['id'], $group['name'], (int)$group['fixed_discount'], (int)$group['variable_discount'], (int)$group['parent_id'], $this);
                //$this -> pass the Grouploader in the new Group for nesting parents of the group
            }
        }
    }

    public function getGroups(): array
    {
        return $this->groups;
    }
}