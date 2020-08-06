<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  CustomerLoader extends DatabaseLoader
{
    private array $customers;
    private Group $group;

    public function __construct()
    {
        $pdo = $this->openConnection();
        $getCustomers = $pdo->prepare('SELECT * FROM customer');
        $getCustomers->execute();
        $customers = $getCustomers->fetchAll();
        //pass group as object Group with group_id of Customer to attach relevant groups to Customer
        $loader = new GroupLoader();
        foreach ($customers as $customer) {
            $this->group = $loader->getGroups()[(int)$customer['group_id']];
            $this->customers[$customer['id']] = new Customer((int)$customer['id'], $customer['firstname'], $customer['lastname'],  (int)$customer['fixed_discount'], (int)$customer['variable_discount'], $this->group);
        }
    }

    public function getCustomers(): array
    {
        return $this->customers;
    }

}