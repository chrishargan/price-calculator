<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render()
    {

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.
        $fetchCustomers = new CustomerLoader();
        $fetchProducts = new ProductLoader();
        $customers = $fetchCustomers->selectCustomers();
        $products = $fetchProducts->selectProducts();
        $groupFetch = new GroupLoader();
        $groups = $groupFetch->selectGroups();
        $selectedCustomer = $_GET['customer'];
        $selectedProduct = $_GET['product'];
        $buttonClicked = $_GET['send'];
        //load the view

        require 'View/homepage.php';

    }
}

