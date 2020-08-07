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
        $products = $productloader->getProducts();
        $customersLoader = new CustomerLoader();
        $customers = $customersLoader->getCustomers();
        /*   $customer1 = $customers[$_GET['customer']];
           $productSelected = $products[$_GET['product']];*/
        /**
         * /*  *
         */
        /*
        $var = $customer1->finalVariableDiscount($productSelected);
        $fix = $customer1->sumFixedDiscount($productSelected);

        */
        if (isset($_GET['product'], $_GET['customer'])) {
            $customer = $customers[(int)$_GET['customer']];
            $product = $products[(int)$_GET['product']];
            $price = $product->getPrice() / 100;
            $name = ucfirst($product->getName());
            $firstName = $customer->getFirstName();
            $lastName = $customer->getLastName();
            $endPrice = round($customer->calculatePrice($product) , 2);
            $discount = round($price - $endPrice, 2);



            //Breakdown of order
            $order = '<br><h3>Hello <strong>' . $firstName . ' ' . $lastName . '</strong>,<br><br><h4> Order Details:<br> 1 x ' . $name . ' at ' . $price . ' &euro;.<br>Discount: ' . $discount . ' &euro;.<hr> Order Total: ' . $endPrice . ' &euro;</h4>';
        } else {
            $order = 'Please select your Name and Product';
        }


        //load the view
        require 'View/homepage.php';

    }
}

