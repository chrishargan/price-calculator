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
        $customer1 = $customers[4];
        /**
         * @var Customer $customer1
         */
        $max= $customer1->finalVariableDiscount($products[5]);
        $fix = $customer1->sumFixedDiscount();

         $message= "";
        if(isset($_GET['product'], $_GET['customer'])){
          $customer = $customers[(int)$_GET['customer']];
          var_dump($customer->getGroup());


          // $finalPrice = $customer->CalculatorPrice($products[(int)$_POST['product']])/100;
        }

     /*   if(isset($DiscountedPrice)) {
            $DiscountedPriceDisplayed= number_format($finalPrice, 2);
         $message = "<h5 class = 'text-center bg-danger text-white p-3 font-weight-bold'> Total cost: &euro; {$DiscountedPriceDisplayed}";
    }*/

        //load the view
        require 'View/homepage.php';
    }
}

