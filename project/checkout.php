<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Grocery Store</title>

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

    <h1>Checkout</h1>

    <form class="form" method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="name"
            required
        >


        <label>Phone Number</label>

        <input
            type="tel"
            name="phone"
            required
        >


        <label>Delivery Address</label>

        <textarea
            name="address"
            rows="5"
            required
        ></textarea>


        <label>Payment Method</label>

        <select name="payment">

            <option value="cod">
                Cash on Delivery
            </option>

            <option value="online">
                Online Payment
            </option>

        </select>


        <button
            type="submit"
            class="button"
        >
            Place Order
        </button>

    </form>

</main>


<footer>

    <p>© 2026 Grocery Store</p>

</footer>


</body>
</html>