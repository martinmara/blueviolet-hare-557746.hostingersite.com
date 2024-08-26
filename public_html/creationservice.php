<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Factories\ProductFactory;
use App\Repositories\ProductRepository;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate common fields
    $sku = $_POST['sku'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $productType = $_POST['productType'] ?? '';

    // Validate required fields
    if (empty($sku) || empty($name) || empty($price) || empty($productType)) {
        echo "Please submit all required data.";
        exit;
    }

    $repository = new ProductRepository();

    // Check if SKU is unique
    if ($repository->isSkuExists($sku)) {
        echo "SKU already exists. Please provide a unique SKU.";
        exit;
    }

    // Create product object using factory pattern
    try {
        $product = ProductFactory::createProduct($productType,$sku, $name, $price );
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    // Set product-specific attributes
    try {
        $product->setAttributes($_POST);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    // Save the product to the database via the repository
    try {
        $repository->saveProduct($product);
        echo "Product saved successfully!";
    } catch (Exception $e) {
        echo "Error saving product: " . $e->getMessage();
        exit;
    }

    // Redirect back to the product list
    header("Location: index.php");
    exit;
}
