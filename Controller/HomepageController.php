<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    //don't echo inside the controller - only assign vars here - the view will display them.
    public function render(): void
    {
        //get customers & products to display in select menu
        $fetchCustomers = new CustomerLoader();
        $customers = $fetchCustomers->getCustomers();
        $fetchProducts = new ProductLoader();
        $products = $fetchProducts->getProducts();

        //get relevant data from product & customer after submitting
        if(isset($_GET['product'], $_GET['customer'])) {
            $customer = $customers[(int)$_GET['customer']];
            $product = $products[(int)$_GET['product']];
            $price = $product->getPrice()/100;
            $name = $product->getName();
            $firstName = $customer->getFirstName();
            $lastName = $customer->getLastName();
            $endPrice = $customer->calculatePrice($product);
            $discount = $price - $endPrice;

            //message for customer to see his/her order
            $order = '<h5>Hello '.$firstName.' '.$lastName.',<br><br> Your order: '.$name.' for '.$price.' &euro;.<br>Your discount: '.$discount.' &euro;.<br>Price to pay: '.$endPrice.' &euro;</h5>';
        } else {
            $order = '';
        }

        //load the view
        require 'View/homepage.php';
    }
}

