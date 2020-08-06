<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    //don't echo inside the controller - only assign vars here - the view will display them.
    public function render()
    {
        $fetchCustomers = new CustomerLoader();
        $customers = $fetchCustomers->getCustomers();
        $fetchProducts = new ProductLoader();
        $products = $fetchProducts->getProducts();

        if(isset($_GET['product'], $_GET['customer'])) {
            $customer = $customers[(int)$_GET['customer']];
            $product = $products[(int)$_GET['product']];
            $price = $product->getPrice();
            $name = $product->getName();
            $firstName = $customer->getFirstName();
            $lastName = $customer->getLastName();
            var_dump($customer);
            var_dump($customer->variableDiscountArray($customer->getGroup()));
            var_dump($customer->fixedDiscountArray($customer->getGroup()));
            var_dump($customer->calculatePrice($product));
            $order = '<h5>Hello '.$firstName.' '.$lastName.',<br><br> You ordered: '.$name.' for '.($price/100).' &euro;.<br>You got x &euro; discount.</h5>';
        } else {
            $order = '';
        }

        //load the view
        require 'View/homepage.php';
    }
}

