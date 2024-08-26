<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Repositories\ProductRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids']) && is_array($data['ids'])) {
        $repository = new ProductRepository();
        $repository->deleteProductsByIds($data['ids']);
        http_response_code(200);
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
}
