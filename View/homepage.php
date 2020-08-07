<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>

    <!-- Customer -->
    <section class="m-3">
        <form method="get">
            <div id="dropdown">
                <select class="mb-1" name="customer">
                    <option value="0">Customer</option>
                    <?php
                    foreach ($customers as $customer) {
                        echo '<option value="'.$customer->getId().'">'.$customer->getFirstName().' '.$customer->getLastName().'</option>';
                    } ?>
                </select>
            </div>
            <div id="dropdown">
                <select class="mb-1" name="product">
                    <option value="0">Product</option>
                    <?php
                    foreach ($products as $product) {
                        echo '<option value="'.$product->getId().'">'.ucfirst($product->getName()).' | '.($product->getPrice()/100). ' &euro;</option>';
                    } ?>
                </select>
            </div>
            <input id="linkBtn" type="submit" name="send" value="Checkout">
        </form>
        <?php
         echo $order;
        ?>
    </section>


<?php require 'includes/footer.php'?>