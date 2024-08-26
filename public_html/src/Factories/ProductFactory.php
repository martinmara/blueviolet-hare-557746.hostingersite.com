<?php
namespace App\Factories;

use App\Models\Dvd;
use App\Models\Book;
use App\Models\Furniture;
use Exception;

class ProductFactory {
    /**
     * Create a product instance based on the type.
     *
     * @param string $type
     * @return Book|DVD|Furniture
     * @throws Exception if the product type is invalid.
     */
    public static function createProduct($type,$sku, $name, $price) {
        switch ($type) {
            case 'Dvd':
                return new Dvd($sku, $name, $price);
            case 'Book':
                return new Book($sku, $name, $price);
            case 'Furniture':
                return new Furniture($sku, $name, $price);
            default:
                throw new Exception("Invalid product type.");
        }
    }
}
