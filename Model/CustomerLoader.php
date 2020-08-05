<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  CustomerLoader extends DatabaseLoader
{
    public function selectCustomers()
    {
        $pdo = $this->openConnection();
        $getCustomers = $pdo->prepare('SELECT * FROM customer');
        $getCustomers->execute();
        $customers = $getCustomers->fetchAll();
        $selectCustomers = [];
        foreach ($customers as $customer) {
            $selectCustomers[] = new Customer((int)$customer['id'], $customer['firstname'], $customer['lastname'], (int)$customer['group_id'], (int)$customer['fixed_discount'], (int)$customer['variable_discount']);
        }
        return $selectCustomers;
    }
}