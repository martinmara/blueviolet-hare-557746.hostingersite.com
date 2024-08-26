<?php
require_once './vendor/autoload.php'; // Use Composer autoload

use App\Repositories\ProductRepository;

$repository = new ProductRepository();
$products = $repository->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
<header>
        <h1>Product List</h1>
        <div class="actions">
            <button onclick="window.location.href='add-product.php'" class="btn-add">ADD</button>
            <button id="delete-product-btn" class="btn-delete">MASS DELETE</button>
        </div>
    </header>
    <hr>
    <div class="product-grid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <input type="checkbox" class="delete-checkbox" data-id="<?= htmlspecialchars($product['id']); ?>">
                <p class="sku"><?= htmlspecialchars($product['sku']); ?></p>
                <p class="product-name"><?= htmlspecialchars($product['name']); ?></p>
                <p class="price"><?= htmlspecialchars($product['price']); ?> $</p>

                <?php
                // Decode the attributes JSON string
                $attributes = json_decode($product['attributes'], true);

                // Check and display the appropriate attribute
                if (isset($attributes['weight'])) {
                    echo '<p class="attribute">Weight: ' . htmlspecialchars($attributes['weight']) . ' kg</p>';
                } elseif (isset($attributes['size'])) {
                    echo '<p class="attribute">Size: ' . htmlspecialchars($attributes['size']) . ' MB</p>';
                } elseif (isset($attributes['height']) && isset($attributes['width']) && isset($attributes['length'])) {
                    echo '<p class="attribute">Dimensions: ' 
                        . htmlspecialchars($attributes['height']) . 'x'
                        . htmlspecialchars($attributes['width']) . 'x'
                        . htmlspecialchars($attributes['length']) . ' cm</p>';
                }
                ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

    <footer>
        <hr>
        <h1>
        Scandiweb Test assignment
        </h1>
    </footer>

    <script>
        // JavaScript to handle mass delete
        document.getElementById('delete-product-btn').addEventListener('click', function() {
            let checkedBoxes = document.querySelectorAll('.delete-checkbox:checked');
            if (checkedBoxes.length > 0) {
                // if (confirm('Are you sure you want to delete selected products?')) {
                    let idsToDelete = Array.from(checkedBoxes).map(box => box.getAttribute('data-id'));
                    // Send delete request to the server
                    fetch('delete-products.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ ids: idsToDelete })
                    }).then(response => {
                        if (response.ok) {
                            checkedBoxes.forEach(box => box.closest('.product-card').remove());
                        } else {
                            alert('Failed to delete products.');
                        }
                    });
                // }
            } else {
                alert('Please select products to delete.');
            }
        });
    </script>
</body>
</html>
