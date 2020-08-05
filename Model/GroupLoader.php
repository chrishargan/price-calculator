<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  GroupLoader extends DatabaseLoader
{
    //fetch customer groups id, name & discounts
    public function selectGroups() {
        $pdo = $this->openConnection();
        $getGroups = $pdo->prepare('SELECT * FROM customer_group');
        $getGroups->execute();
        $groups = $getGroups->fetchAll();
        $selectGroups = [];
        foreach ($groups as $group) {
            $selectGroups[] = new Group((int)$group['id'], (int)$group['parent_id'], $group['name'], (int)$group['fixed_discount'], (int)$group['variable_discount']);
        }
        return $selectGroups;
    }
}