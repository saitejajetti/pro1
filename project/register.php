<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'] ?? "";

    $email = $_POST['email'] ?? "";

    $password = $_POST['password'] ?? "";

    $message = "Registration system will be connected to SQLite next.";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Grocery Store</title>

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

        <a href="login.php">Login</a>

    </nav>

</header>


<main class="container">

    <div class="form-box">

        <h1>Create Account</h1>


        <?php if ($message): ?>

            <p>
                <?php echo $message; ?>
            </p>

        <?php endif; ?>


        <form method="POST">

            <label>Name</label>

            <input
                type="text"
                name="name"
                required
            >


            <label>Email</label>

            <input
                type="email"
                name="email"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >


            <button
                type="submit"
                class="button"
            >
                Register
            </button>

        </form>


        <p>
            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>

    </div>

</main>


</body>
</html>