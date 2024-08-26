<?php
namespace App\Models;

class Dvd extends Product {
    private $size;

    public function __construct($sku, $name, $price) {
        parent::__construct($sku, $name, $price);
    }

    public function setAttributes($data) {
        $this->validateAttributes($data);
        $this->size = $data['size'];
    }

    protected function validateAttributes($data) {
        if (!isset($data['size'])) {
            throw new \Exception("Please provide the size in MB.");
        }
    }

    public function displayAttribute() {
        return "Size: " . $this->size . " MB";
    }

    public function getAttributes() {
        return ['size' => $this->size];
    }
}

