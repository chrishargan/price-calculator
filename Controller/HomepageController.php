<?php
declare(strict_types = 1);

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render()
    {
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.
        $products = selectProducts();
        $customers = selectCustomers();

        //load the view
        require 'View/homepage.php';
    }
}

$controller = new HomepageController();
$controller->render();