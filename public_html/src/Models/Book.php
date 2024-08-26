<?php
namespace App\Models;

class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price) {
        parent::__construct($sku, $name, $price);
    }

    public function setAttributes($data) {
        $this->validateAttributes($data);
        $this->weight = $data['weight'];
    }

    protected function validateAttributes($data) {
        if (!isset($data['weight'])) {
            throw new \Exception("Please provide the weight in Kg.");
        }
    }

    public function displayAttribute() {
        return "Weight: " . $this->weight + " Kg";
    }

    public function getAttributes() {
        return ['weight' => $this->weight];
    }
}


