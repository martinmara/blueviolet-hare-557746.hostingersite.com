<?php
namespace App\Models;

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price) {
        parent::__construct($sku, $name, $price);
    }

    public function setAttributes($data) {
        $this->validateAttributes($data);
        $this->height = $data['height'];
        $this->width = $data['width'];
        $this->length = $data['length'];
    }

    protected function validateAttributes($data) {
        if (!isset($data['height']) || !isset($data['width']) || !isset($data['length'])) {
            throw new \Exception("Please provide all dimensions (Height, Width, Length).");
        }
    }

    public function displayAttribute() {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length . " cm";
    }

    public function getAttributes() {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length
        ];
    }
}
