<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  CustomerLoader extends DatabaseLoader
{
    private array $customers;

    public function __construct()
    {
        $pdo = $this->openConnection();
        $getCustomers = $pdo->prepare('SELECT * FROM customer');
        $getCustomers->execute();
        $customers = $getCustomers->fetchAll();
        foreach ($customers as $customer) {
            $this->customers[$customer['id']] = new Customer((int)$customer['id'], $customer['firstname'], $customer['lastname'],  (int)$customer['fixed_discount'], (int)$customer['variable_discount'], (int)$customer['group_id']);
        }
    }

    public function getCustomers(): array
    {
        return $this->customers;
    }

}