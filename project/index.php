<?php
require_once "database/database.php";

$result = $db->query("
    SELECT *
    FROM products
    ORDER BY id DESC
    LIMIT 8
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Saiteja Grocers</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #ffffff;
            color: #111;
        }

        /* HEADER */

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 7%;
            border-bottom: 1px solid #ddd;
            background: white;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
        }

        nav a {
            text-decoration: none;
            color: #111;
            margin-left: 25px;
            font-size: 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* HERO */

        .hero {
            min-height: 420px;
            padding: 70px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f5f5f5;
        }

        .hero-text {
            max-width: 550px;
        }

        .hero-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .shop-btn {
            display: inline-block;
            background: #111;
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 5px;
        }

        .shop-btn:hover {
            background: #333;
        }

        .hero-box {
            width: 350px;
            height: 250px;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 70px;
            border-radius: 10px;
        }

        /* CATEGORIES */

        .section {
            padding: 50px 7%;
        }

        .section h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 30px;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
        }

        .category {
            border: 1px solid #ddd;
            padding: 25px 10px;
            text-align: center;
            border-radius: 8px;
            background: white;
        }

        .category:hover {
            background: #f5f5f5;
        }

        .category-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        /* PRODUCTS */

        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background: white;
        }

        .product img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .product h3 {
            margin-bottom: 8px;
        }

        .price {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .view-btn {
            display: inline-block;
            padding: 9px 15px;
            background: #111;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        /* OFFER */

        .offer {
            margin: 20px 7% 50px;
            padding: 45px;
            background: #111;
            color: white;
            text-align: center;
            border-radius: 10px;
        }

        .offer h2 {
            margin-bottom: 10px;
        }

        /* FOOTER */

        footer {
            background: #111;
            color: white;
            padding: 35px 7%;
            text-align: center;
        }

        footer p {
            margin: 8px;
            color: #ccc;
        }

        /* MOBILE */

        @media (max-width: 900px) {

            .hero {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }

            .categories {
                grid-template-columns: repeat(3, 1fr);
            }

            .products {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {

            header {
                flex-direction: column;
                gap: 15px;
            }

            nav a {
                margin: 8px;
            }

            .hero-text h1 {
                font-size: 35px;
            }

            .hero-box {
                width: 100%;
            }

            .categories {
                grid-template-columns: repeat(2, 1fr);
            }

            .products {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<!-- HEADER -->

<header>

    <div class="logo">
        Saiteja Grocers
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="login.php">Login</a>
    </nav>

</header>


<!-- HERO -->

<section class="hero">

    <div class="hero-text">

        <h1>
            Fresh Groceries,<br>
            Delivered Easily.
        </h1>

        <p>
            Shop vegetables, fruits, groceries, dairy products,
            snacks and more from Saiteja Grocers.
        </p>

        <a href="products.php" class="shop-btn">
            Shop Now
        </a>

    </div>

    <div class="hero-box">
        🛒
    </div>

</section>


<!-- CATEGORIES -->

<section class="section">

    <h2>Shop by Category</h2>

    <div class="categories">

        <div class="category">
            <div class="category-icon">🥦</div>
            Vegetables
        </div>

        <div class="category">
            <div class="category-icon">🍎</div>
            Fruits
        </div>

        <div class="category">
            <div class="category-icon">🌾</div>
            Grains
        </div>

        <div class="category">
            <div class="category-icon">🥛</div>
            Dairy
        </div>

        <div class="category">
            <div class="category-icon">🥤</div>
            Beverages
        </div>

        <div class="category">
            <div class="category-icon">🍪</div>
            Snacks
        </div>

    </div>

</section>


<!-- OFFER -->

<section class="offer">

    <h2>Special Offers</h2>

    <p>
        Discover great deals and discounts on your daily groceries.
    </p>

</section>


<!-- PRODUCTS -->

<section class="section">

    <h2>Latest Products</h2>

    <div class="products">

        <?php while ($product = $result->fetchArray(SQLITE3_ASSOC)): ?>

            <div class="product">

                <?php if (!empty($product['image'])): ?>

                    <img
                        src="<?php echo htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                    >

                <?php else: ?>

                    <div style="
                        height:180px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        background:#f2f2f2;
                        font-size:50px;
                    ">
                        🛒
                    </div>

                <?php endif; ?>


                <h3>
                    <?php echo htmlspecialchars($product['name']); ?>
                </h3>

                <div class="price">
                    ₹<?php echo number_format($product['selling_price'], 2); ?>
                </div>

                <a
                    href="product.php?id=<?php echo $product['id']; ?>"
                    class="view-btn"
                >
                    View Product
                </a>

            </div>

        <?php endwhile; ?>

    </div>

</section>


<!-- FOOTER -->

<footer>

    <h3>Saiteja Grocers</h3>

    <p>Your local grocery shopping website.</p>

    <p>Fresh Products • Easy Shopping • Great Prices</p>

    <p>© 2026 Saiteja Grocers</p>

</footer>

</body>
</html>