<?php
namespace App\Models;

abstract class Product {
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function displayAttribute();
    abstract public function setAttributes($data);
    abstract public function getAttributes(); // New abstract method

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function validate() {
        if (empty($this->sku) || empty($this->name) || empty($this->price)) {
            throw new \Exception("Please submit all required data.");
        }
    }
}
