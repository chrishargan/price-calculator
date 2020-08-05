<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class  ProductLoader extends DatabaseLoader
{
    public function selectProducts()
    {
        $pdo = $this->openConnection();
        $getProducts = $pdo->prepare('SELECT * FROM product');
        $getProducts->execute();
        $products = $getProducts->fetchAll();
        $selectProducts = [];
        foreach ($products as $product) {
            $selectProducts[] = new Product((int)$product['id'], $product['name'], (int)$product['price']);
        }
        return $selectProducts;
    }
}