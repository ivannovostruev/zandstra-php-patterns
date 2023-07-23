<?php
// Facade

use patterns\Facade\ProductFacade;

require_once 'autoload.php';

$facade = new ProductFacade('patterns/Facade/test.txt');
$products = $facade->getProducts();

echo '<pre>';
print_r($products);
print_r($facade->getProduct(234));
print_r($facade->getProduct(532));
