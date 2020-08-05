<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  ProductLoader extends DatabaseLoader
{
    private array $products;

    public function __construct()
    {
        $pdo = $this->openConnection();
        $getProducts = $pdo->prepare('SELECT * FROM product');
        $getProducts->execute();
        $products = $getProducts->fetchAll();
        foreach ($products as $product) {
            $this->products[$product['id']] = new Product((int)$product['id'], $product['name'], (int)$product['price']);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}