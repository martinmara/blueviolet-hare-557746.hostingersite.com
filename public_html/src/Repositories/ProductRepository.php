<?php
namespace App\Repositories;

use App\Database\Database;
use App\Models\Product;
use PDO; 

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }
 
    public function isSkuExists($sku) {
        try {
            $query = "SELECT * FROM products WHERE sku = :sku";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':sku', $sku);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (\Exception $e) {
            throw new \Exception("Generic error " . $e->getMessage());
        }
    }

    public function getProducts() {
        try{
            $query = "SELECT * FROM products ORDER BY id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Generic error " . $e->getMessage());
        }
    }

    public function deleteProductsByIds(array $ids) {
        try {
            $query = "DELETE FROM products WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Error deleting product: " . $e->getMessage());
        }
    }

    public function saveProduct(Product $product) {
        $product->validate();
    
        try {
            $query = "INSERT INTO products (sku, name, price, type, attributes) VALUES (:sku, :name, :price, :type, :attributes)";
            $stmt = $this->db->prepare($query);
    
            // Assign method results to variables
            $sku = $product->getSku();
            $name = $product->getName();
            $price = $product->getPrice();
    
            // Bind common product attributes
            $stmt->bindParam(':sku', $sku);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
    
            // Determine the product type and store additional attributes as JSON
            $type = get_class($product); // e.g., App\Models\Book
            $type = substr($type, strrpos($type, '\\') + 1); // Extract class name, e.g., Book, DVD, Furniture
            $stmt->bindParam(':type', $type);
    
            // Use polymorphism to get product-specific attributes
            $attributes = json_encode($product->getAttributes());
            $stmt->bindParam(':attributes', $attributes);
    
            $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Error saving product: " . $e->getMessage());
        }
    }
    
}
