<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'secret.php';

function openConnection(): PDO
{
$dbhost = "localhost";
$dbuser = DB_USER;
$dbpass = DB_PASS;
$db = DB_NAME;

$driverOptions = [
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

return new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
}

//fetch customer names
function selectCustomers() {
    $pdo = openConnection();
    $getCustomers = $pdo->prepare('SELECT firstname, lastname FROM customer');
    $getCustomers->execute();
    $customers = $getCustomers->fetchAll();
    $selectCustomers = [];
    foreach ($customers as $customer) {
        $selectCustomers[] = new Customer($customer['firstname'], $customer['lastname']);
    }
    return $selectCustomers;
}

//fetch products & prices
function selectProducts() {
    $pdo = openConnection();
    $getProducts = $pdo->prepare('SELECT name, price FROM product');
    $getProducts->execute();
    $products = $getProducts->fetchAll();
    $selectProducts = [];
    foreach ($products as $product) {
        $selectProducts[] = new Product($product['name'], (int)$product['price']);
    }
    return $selectProducts;
}

//fetch customer groups & discounts
function selectGroups() {
    $pdo = openConnection();
    $getGroups = $pdo->prepare('SELECT name, fixed_discount, variable_discount FROM customer_group');
    $getGroups->execute();
    $groups = $getGroups->fetchAll();
    $selectGroups = [];
    foreach ($groups as $group) {
            $selectGroups[] = new CustomerGroup($group['name'], (int)$group['fixed_discount'], (int)$group['variable_discount']);
    }
    return $selectGroups;
}
