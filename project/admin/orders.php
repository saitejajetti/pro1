<?php

require_once "../database/database.php";

/*
|--------------------------------------------------------------------------
| GET ORDERS FROM SQLITE
|--------------------------------------------------------------------------
*/

$result = $db->query("
    SELECT *
    FROM orders
    ORDER BY id DESC
");

$orders = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $orders[] = $row;
}


/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

$search = isset($_GET['search'])
    ? trim($_GET['search'])
    : '';


/*
|--------------------------------------------------------------------------
| STATUS FILTER
|--------------------------------------------------------------------------
*/

$statusFilter = isset($_GET['status'])
    ? trim($_GET['status'])
    : '';


/*
|--------------------------------------------------------------------------
| FILTER ORDERS
|--------------------------------------------------------------------------
*/

$filteredOrders = [];

foreach ($orders as $order) {

    $matchesSearch = true;
    $matchesStatus = true;

    if ($search !== '') {

        $searchText = strtolower($search);

        $customer = strtolower($order['customer']);
        $orderId = strtolower($order['order_number']);
        $phone = strtolower($order['phone']);

        if (
            strpos($customer, $searchText) === false &&
            strpos($orderId, $searchText) === false &&
            strpos($phone, $searchText) === false
        ) {
            $matchesSearch = false;
        }
    }

    if ($statusFilter !== '') {

        if ($order['status'] !== $statusFilter) {
            $matchesStatus = false;
        }
    }

    if ($matchesSearch && $matchesStatus) {
        $filteredOrders[] = $order;
    }
}


/*
|--------------------------------------------------------------------------
| STATISTICS
|--------------------------------------------------------------------------
*/

$totalOrders = count($orders);

$pendingOrders = 0;
$confirmedOrders = 0;
$deliveredOrders = 0;
$cancelledOrders = 0;

$totalSales = 0;

foreach ($orders as $order) {

    $totalSales += $order['amount'];

    if ($order['status'] === 'Pending') {
        $pendingOrders++;
    }

    if ($order['status'] === 'Confirmed') {
        $confirmedOrders++;
    }

    if ($order['status'] === 'Delivered') {
        $deliveredOrders++;
    }

    if ($order['status'] === 'Cancelled') {
        $cancelledOrders++;
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Orders - Saiteja Grocers</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f5f5;
    color: #111;
}

/* SIDEBAR */

.sidebar {
    position: fixed;
    left: 0;
    top: 0;

    width: 250px;
    height: 100vh;

    background: #111;
    color: white;

    padding: 25px 15px;

    overflow-y: auto;
}

.logo {
    text-align: center;
    font-size: 23px;
    font-weight: bold;
    margin-bottom: 5px;
}

.admin-title {
    text-align: center;
    color: #aaa;
    font-size: 13px;
    margin-bottom: 30px;
}

.menu a {
    display: block;

    text-decoration: none;
    color: #ddd;

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

/* MAIN */

.main {
    margin-left: 250px;
    padding: 30px;
    min-height: 100vh;
}

/* TOP BAR */

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 30px;
}

.topbar h1 {
    font-size: 30px;
}

.topbar p {
    margin-top: 6px;
    color: #777;
}

/* STATISTICS */

.stats {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 18px;

    margin-bottom: 30px;
}

.stat {
    background: white;

    border: 1px solid #e5e5e5;

    border-radius: 10px;

    padding: 22px;
}

.stat-title {
    color: #777;

    font-size: 14px;

    margin-bottom: 10px;
}

.stat-number {
    font-size: 28px;
    font-weight: bold;
}

/* SEARCH */

.search-box {
    background: white;

    padding: 20px;

    border-radius: 10px;

    margin-bottom: 25px;

    border: 1px solid #e5e5e5;
}

.search-form {
    display: flex;

    gap: 10px;

    flex-wrap: wrap;
}

.search-input {
    flex: 1;

    min-width: 220px;

    padding: 13px;

    border: 1px solid #ccc;

    border-radius: 6px;

    font-size: 15px;
}

.status-select {
    padding: 13px;

    border: 1px solid #ccc;

    border-radius: 6px;

    background: white;

    min-width: 160px;
}

.search-button {
    padding: 13px 22px;

    background: #111;

    color: white;

    border: none;

    border-radius: 6px;

    cursor: pointer;

    font-weight: bold;
}

.clear-button {
    display: inline-block;

    padding: 13px 22px;

    background: #eee;

    color: #111;

    text-decoration: none;

    border-radius: 6px;
}

/* TABLE */

.table-box {
    background: white;

    border: 1px solid #ddd;

    border-radius: 10px;

    overflow-x: auto;
}

table {
    width: 100%;

    border-collapse: collapse;

    min-width: 1000px;
}

th {
    background: #111;

    color: white;

    padding: 15px;

    text-align: left;
}

td {
    padding: 15px;

    border-bottom: 1px solid #eee;
}

.status {
    padding: 6px 10px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: bold;
}

.pending {
    background: #fff3cd;
    color: #856404;
}

.confirmed {
    background: #dbeafe;
    color: #1e40af;
}

.delivered {
    background: #d9f7df;
    color: #176b2c;
}

.cancelled {
    background: #ffdede;
    color: #a00000;
}

/* MOBILE */

@media(max-width:1000px) {

    .stats {
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

        padding: 20px;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    .search-form {
        flex-direction: column;
    }
}

</style>

</head>

<body>


<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="logo">
        SAITEJA GROCERS
    </div>

    <div class="admin-title">
        ADMIN PANEL
    </div>

    <nav class="menu">

        <a href="index.php">
            🏠 Dashboard
        </a>

        <a href="products.php">
            📦 Products
        </a>

        <a href="add_product.php">
            ➕ Add Product
        </a>

        <a href="orders.php" class="active">
            🛒 Orders
        </a>

        <a href="payments.php">
            💳 Payments
        </a>

        <a href="sales.php">
            📊 Sales
        </a>

        <a href="profits.php">
            💰 Profits
        </a>

        <a href="discounts.php">
            🏷️ Discounts
        </a>

        <a href="users.php">
            👥 Users
        </a>

        <a href="helpdesk.php">
            ❓ Help Desk
        </a>

        <a href="ml_questions.php">
            🤖 ML Questions
        </a>

        <a href="../index.php">
            🌐 View Website
        </a>

        <a href="login.php" class="logout">
            🚪 Logout
        </a>

    </nav>

</aside>


<!-- MAIN -->

<main class="main">

    <div class="topbar">

        <div>

            <h1>Orders</h1>

            <p>
                Manage customer orders
            </p>

        </div>

    </div>


    <!-- STATISTICS -->

    <section class="stats">

        <div class="stat">

            <div class="stat-title">
                Total Orders
            </div>

            <div class="stat-number">
                <?php echo $totalOrders; ?>
            </div>

        </div>


        <div class="stat">

            <div class="stat-title">
                Pending
            </div>

            <div class="stat-number">
                <?php echo $pendingOrders; ?>
            </div>

        </div>


        <div class="stat">

            <div class="stat-title">
                Confirmed
            </div>

            <div class="stat-number">
                <?php echo $confirmedOrders; ?>
            </div>

        </div>


        <div class="stat">

            <div class="stat-title">
                Delivered
            </div>

            <div class="stat-number">
                <?php echo $deliveredOrders; ?>
            </div>

        </div>

    </section>


    <!-- SEARCH -->

    <section class="search-box">

        <form
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Search customer, order ID or phone"
                value="<?php echo htmlspecialchars($search); ?>"
            >


            <select
                name="status"
                class="status-select"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="Pending"
                    <?php if ($statusFilter === 'Pending') echo 'selected'; ?>
                >
                    Pending
                </option>

                <option
                    value="Confirmed"
                    <?php if ($statusFilter === 'Confirmed') echo 'selected'; ?>
                >
                    Confirmed
                </option>

                <option
                    value="Delivered"
                    <?php if ($statusFilter === 'Delivered') echo 'selected'; ?>
                >
                    Delivered
                </option>

                <option
                    value="Cancelled"
                    <?php if ($statusFilter === 'Cancelled') echo 'selected'; ?>
                >
                    Cancelled
                </option>

            </select>


            <button
                type="submit"
                class="search-button"
            >
                Search
            </button>


            <a
                href="orders.php"
                class="clear-button"
            >
                Clear
            </a>

        </form>

    </section>


    <!-- ORDERS TABLE -->

    <section class="table-box">

        <table>

            <thead>

                <tr>

                    <th>
                        Order ID
                    </th>

                    <th>
                        Customer
                    </th>

                    <th>
                        Phone
                    </th>

                    <th>
                        Items
                    </th>

                    <th>
                        Amount
                    </th>

                    <th>
                        Payment
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>


            <tbody>

            <?php if (count($filteredOrders) > 0) { ?>

                <?php foreach ($filteredOrders as $order) { ?>

                    <?php

                    $statusClass = strtolower(
                        $order['status']
                    );

                    ?>

                    <tr>

                        <td>
                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $order['order_number']
                                );
                                ?>
                            </strong>
                        </td>


                        <td>

                            <strong>
                                <?php
                                echo htmlspecialchars(
                                    $order['customer']
                                );
                                ?>
                            </strong>

                            <br>

                            <small>
                                <?php
                                echo htmlspecialchars(
                                    $order['email']
                                );
                                ?>
                            </small>

                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $order['phone']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $order['items']
                            );
                            ?>
                        </td>


                        <td>
                            ₹<?php
                            echo number_format(
                                $order['amount'],
                                2
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $order['payment']
                            );
                            ?>
                        </td>


                        <td>

                            <span
                                class="status <?php
                                echo $statusClass;
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $order['status']
                                );
                                ?>

                            </span>

                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $order['date']
                            );
                            ?>
                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td
                        colspan="8"
                        style="text-align:center;padding:30px;"
                    >

                        No orders found.

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </section>

</main>

</body>

</html>