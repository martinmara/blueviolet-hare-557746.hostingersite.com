<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add-product.css">
    <title>Add Product</title>
</head>
<body>
<header>
        <h1>Product Addd</h1>
        <div class="form-actions">
           
            <button type="button" onclick="document.getElementById('product_form').submit();" class="btn-save">Save</button>
            <button type="button" onclick="window.location.href='index.php'" class="btn-cancel">Cancel</button>
        </div>
    </header>
    <hr>

    <form id="product_form" action="creationservice.php" method="POST">
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" id="sku" name="sku" required>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="text" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="productType">Type Switcher</label>
            <select id="productType" name="productType" required>
                <option value="" disabled selected>Select product type</option>
                <option value="Dvd">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
        </div>

        <div id="dvdAttributes" class="attributes" style="display:none;">
            <div class="form-group">
                <label for="size">Size (MB)</label>
                <input type="text" id="size" name="size">
                <p class="description">Please, provide size in MB.</p>
            </div>
        </div>

        <div id="bookAttributes" class="attributes" style="display:none;">
            <div class="form-group">
                <label for="weight">Weight (KG)</label>
                <input type="text" id="weight" name="weight">
                <p class="description">Please, provide weight in KG.</p>
            </div>
        </div>

        <div id="furnitureAttributes" class="attributes" style="display:none;">
            <div class="form-group">
                <label for="height">Height (CM)</label>
                <input type="text" id="height" name="height">
            </div>
            <div class="form-group">
                <label for="width">Width (CM)</label>
                <input type="text" id="width" name="width">
            </div>
            <div class="form-group">
                <label for="length">Length (CM)</label>
                <input type="text" id="length" name="length">
                <p class="description">Please, provide dimensions in HxWxL format.</p>
            </div>
        </div>

       
    </form>
<hr>
    <footer>
        <h1>Scandiweb Test assignment</h1>
    </footer>

    <script>
        document.getElementById('productType').addEventListener('change', function() {
            let dvdAttributes = document.getElementById('dvdAttributes');
            let bookAttributes = document.getElementById('bookAttributes');
            let furnitureAttributes = document.getElementById('furnitureAttributes');

            dvdAttributes.style.display = 'none';
            bookAttributes.style.display = 'none';
            furnitureAttributes.style.display = 'none';

            if (this.value === 'Dvd') {
                dvdAttributes.style.display = 'block';
            } else if (this.value === 'Book') {
                bookAttributes.style.display = 'block';
            } else if (this.value === 'Furniture') {
                furnitureAttributes.style.display = 'block';
            }
        });
    </script>

</body>
</html>
