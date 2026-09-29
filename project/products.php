<?php
require_once "database/database.php";

$result = $db->query("SELECT * FROM products");

$page_title = "Products";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $page_title; ?> - Saiteja Grocers</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="header">

    <div class="logo">
        🛒 Saiteja Grocers
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

    <h1>Our Products</h1>

    <div class="products">

        <?php while ($product = $result->fetchArray(SQLITE3_ASSOC)) { ?>

            <div class="product-card">

                <div class="product-image">

                    <?php if (!empty($product['image'])) { ?>

                        <img
                            src="<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                        >

                    <?php } else { ?>

                        🛒

                    <?php } ?>

                </div>

                <h3>
                    <?php echo htmlspecialchars($product['name']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>

                <h3>
                    ₹<?php echo number_format($product['selling_price'], 2); ?>
                </h3>

                <?php if ($product['discount'] > 0) { ?>

                    <p>
                        Discount: <?php echo $product['discount']; ?>%
                    </p>

                <?php } ?>

                <a
                    href="product.php?id=<?php echo $product['id']; ?>"
                    class="button"
                >
                    View Product
                </a>

            </div>

        <?php } ?>

    </div>

</main>


<footer>

    <h3>Saiteja Grocers</h3>

    <p>Your local online grocery store.</p>

    <p>© 2026 Saiteja Grocers</p>

</footer>


</body>
</html>