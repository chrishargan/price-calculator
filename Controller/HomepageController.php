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

        $productloader = new ProductLoader();
        $products = $productloader ->getProducts();
        $customersLoader = new CustomerLoader();
        $customers = $customersLoader->getCustomers();
        $customer1 = $customers[$_GET['customer']];
        $productSelected = $products[$_GET['product']];
        /**
         * @var Customer $customer1
         */
        $var = $customer1->finalVariableDiscount($productSelected);
        $fix = $customer1->sumFixedDiscount($productSelected);
        $price = $customer1->calculatePrice($productSelected);



        $message= "";
        if(isset($_GET['product'], $_GET['customer'])){
          $customer = $customers[(int)$_GET['customer']];
          var_dump($price);
        }



        //load the view
        require 'View/homepage.php';
    }
}

