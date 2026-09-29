<?php

$product_id = $_GET['id'] ?? 0;

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product - Grocery Store</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>


<header class="header">

    <div class="logo">
        🛒 Grocery Store
    </div>

    <nav>

        <a href="index.php">Home</a>

        <a href="products.php">Products</a>

        <a href="cart.php">Cart</a>

        <a href="orders.php">Orders</a>

        <a href="login.php">Login</a>

    </nav>

</header>


<main class="container">

    <h1>Product Details</h1>

    <div class="product-details">

        <div class="product-image large">
            🍎
        </div>

        <div>

            <h2>Fresh Apples</h2>

            <p>
                Fresh and high-quality apples.
            </p>

            <h2>₹120</h2>

            <p>
                Available: In Stock
            </p>

            <form action="cart.php" method="POST">

                <input
                    type="hidden"
                    name="product_id"
                    value="<?php echo $product_id; ?>"
                >

                <label>Quantity</label>

                <input
                    type="number"
                    name="quantity"
                    value="1"
                    min="1"
                >

                <br><br>

                <button
                    type="submit"
                    class="button"
                >
                    Add to Cart
                </button>

            </form>

        </div>

    </div>

</main>


<footer>

    <p>© 2026 Grocery Store</p>

</footer>


</body>
</html>