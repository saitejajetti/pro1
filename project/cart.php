<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $product_id = $_POST['product_id'] ?? 0;

    $quantity = $_POST['quantity'] ?? 1;

    echo "Product added to cart.";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart - Grocery Store</title>

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

    <h1>Shopping Cart</h1>

    <div class="cart">

        <h2>Your Cart</h2>

        <p>Your cart is currently empty.</p>

        <a href="products.php" class="button">
            Continue Shopping
        </a>

    </div>

</main>


<footer>

    <p>© 2026 Grocery Store</p>

</footer>


</body>
</html>