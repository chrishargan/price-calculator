<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


public function render(): void {
    $productloader = new ProductLoader();
    $products = $productloader ->getProducts();

    $customersLoader = new CustomerLoader();
    $customers = $customersLoader->getCustomers();

    $message= "";
    if(isset($_POST['product'], $_POST['customer'])){
    $customer = $customers[(int)$_POST['customer']];
    $finalPrice = $customer->CalculatorPrice($products[(int)$_POST['product']])/100;
    }
}



