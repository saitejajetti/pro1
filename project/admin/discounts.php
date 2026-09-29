<?php
session_start();

if (!isset($_SESSION['discounts'])) {
    $_SESSION['discounts'] = [
        [
            'id' => 1,
            'code' => 'WELCOME10',
            'type' => 'Percentage',
            'value' => 10,
            'minimum' => 500,
            'status' => 'Active'
        ],
        [
            'id' => 2,
            'code' => 'SAVE50',
            'type' => 'Fixed',
            'value' => 50,
            'minimum' => 300,
            'status' => 'Active'
        ]
    ];
}


/* Add discount */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code = strtoupper(trim($_POST['code']));
    $type = $_POST['type'];
    $value = floatval($_POST['value']);
    $minimum = floatval($_POST['minimum']);

    $ids = array_column($_SESSION['discounts'], 'id');

    $newId = count($ids) > 0 ? max($ids) + 1 : 1;

    $_SESSION['discounts'][] = [
        'id' => $newId,
        'code' => $code,
        'type' => $type,
        'value' => $value,
        'minimum' => $minimum,
        'status' => 'Active'
    ];

    header('Location: discounts.php');

    exit;
}


/* Delete discount */

if (isset($_GET['delete'])) {

    $deleteId = intval($_GET['delete']);

    foreach ($_SESSION['discounts'] as $index => $discount) {

        if ($discount['id'] == $deleteId) {

            unset($_SESSION['discounts'][$index]);

            $_SESSION['discounts'] = array_values(
                $_SESSION['discounts']
            );

            break;
        }
    }

    header('Location: discounts.php');

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Discounts - Saiteja Grocers</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    color: #111;
}

.sidebar {
    position: fixed;
    width: 250px;
    height: 100vh;
    background: #111;
    color: white;
    padding: 25px 15px;
}

.logo {
    text-align: center;
    font-size: 23px;
    font-weight: bold;
}

.admin-title {
    text-align: center;
    color: #aaa;
    margin: 7px 0 30px;
    font-size: 13px;
}

.menu a {
    display: block;
    color: #ddd;
    text-decoration: none;
    padding: 13px 15px;
    margin-bottom: 5px;
    border-radius: 6px;
}

.menu a:hover,
.menu a.active {
    background: white;
    color: #111;
}

.logout {
    margin-top: 25px;
    background: #c62828;
    color: white !important;
}

.main {
    margin-left: 250px;
    padding: 30px;
}

h1 {
    font-size: 30px;
}

.subtitle {
    color: #777;
    margin: 7px 0 30px;
}

.form-box,
.table-box {
    background: white;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #ddd;
    margin-bottom: 30px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 7px;
}

input,
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

button {
    width: 100%;
    padding: 12px;
    background: #111;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 25px;
}

button:hover {
    background: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #111;
    color: white;
    padding: 14px;
    text-align: left;
}

td {
    padding: 14px;
    border-bottom: 1px solid #eee;
}

.active-status {
    color: #176b2c;
    font-weight: bold;
}

.delete {
    color: #c62828;
    text-decoration: none;
    font-weight: bold;
}

@media(max-width:1000px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width:700px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .main {
        margin-left: 0;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }
}

</style>

</head>

<body>

<aside class="sidebar">

    <div class="logo">
        SAITEJA GROCERS
    </div>

    <div class="admin-title">
        ADMIN PANEL
    </div>

    <nav class="menu">

        <a href="index.php">🏠 Dashboard</a>
        <a href="products.php">📦 Products</a>
        <a href="add_product.php">➕ Add Product</a>
        <a href="orders.php">🛒 Orders</a>
        <a href="payments.php">💳 Payments</a>
        <a href="sales.php">📊 Sales</a>
        <a href="profits.php">💰 Profits</a>
        <a href="discounts.php" class="active">🏷️ Discounts</a>
        <a href="users.php">👥 Users</a>
        <a href="helpdesk.php">❓ Help Desk</a>
        <a href="ml_questions.php">🤖 ML Questions</a>
        <a href="../index.php">🌐 View Website</a>
        <a href="login.php" class="logout">🚪 Logout</a>

    </nav>

</aside>


<main class="main">

    <h1>Discounts</h1>

    <p class="subtitle">
        Create and manage discount codes.
    </p>


    <!-- ADD DISCOUNT -->

    <div class="form-box">

        <h2>Add New Discount</h2>

        <br>

        <form method="POST">

            <div class="form-grid">

                <div>

                    <label>
                        Discount Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        placeholder="Example: SAVE20"
                        required
                    >

                </div>


                <div>

                    <label>
                        Discount Type
                    </label>

                    <select name="type">

                        <option value="Percentage">
                            Percentage
                        </option>

                        <option value="Fixed">
                            Fixed Amount
                        </option>

                    </select>

                </div>


                <div>

                    <label>
                        Value
                    </label>

                    <input
                        type="number"
                        name="value"
                        min="0"
                        step="0.01"
                        required
                    >

                </div>


                <div>

                    <label>
                        Minimum Order
                    </label>

                    <input
                        type="number"
                        name="minimum"
                        min="0"
                        step="0.01"
                        value="0"
                        required
                    >

                </div>

            </div>


            <button type="submit">
                Add Discount
            </button>

        </form>

    </div>


    <!-- DISCOUNT LIST -->

    <div class="table-box">

        <h2>Available Discounts</h2>

        <br>

        <table>

            <thead>

                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Minimum Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php foreach ($_SESSION['discounts'] as $discount): ?>

                <tr>

                    <td>
                        <strong>
                            <?php echo htmlspecialchars($discount['code']); ?>
                        </strong>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($discount['type']); ?>
                    </td>

                    <td>

                        <?php if ($discount['type'] === 'Percentage'): ?>

                            <?php echo $discount['value']; ?>%

                        <?php else: ?>

                            ₹<?php echo number_format($discount['value'], 2); ?>

                        <?php endif; ?>

                    </td>

                    <td>
                        ₹<?php echo number_format($discount['minimum'], 2); ?>
                    </td>

                    <td class="active-status">
                        <?php echo $discount['status']; ?>
                    </td>

                    <td>

                        <a
                            class="delete"
                            href="discounts.php?delete=<?php echo $discount['id']; ?>"
                            onclick="return confirm('Delete this discount?');"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</main>

</body>

</html>