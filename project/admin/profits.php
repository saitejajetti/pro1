<?php
session_start();

/* Temporary profit data */
if (!isset($_SESSION['profit_data'])) {
    $_SESSION['profit_data'] = [
        [
            'order_id' => 'SG1001',
            'date' => '2026-09-29',
            'sales' => 540,
            'cost' => 400
        ],
        [
            'order_id' => 'SG1002',
            'date' => '2026-09-29',
            'sales' => 320,
            'cost' => 230
        ],
        [
            'order_id' => 'SG1003',
            'date' => '2026-09-28',
            'sales' => 760,
            'cost' => 580
        ],
        [
            'order_id' => 'SG1004',
            'date' => '2026-09-28',
            'sales' => 280,
            'cost' => 210
        ]
    ];
}

$profits = $_SESSION['profit_data'];

$totalSales = 0;
$totalCost = 0;

foreach ($profits as $item) {
    $totalSales += $item['sales'];
    $totalCost += $item['cost'];
}

$totalProfit = $totalSales - $totalCost;

$profitMargin = 0;

if ($totalSales > 0) {
    $profitMargin = ($totalProfit / $totalSales) * 100;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profits - Saiteja Grocers</title>

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
    left: 0;
    top: 0;
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
    margin-top: 7px;
    margin-bottom: 30px;
}

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #e5e5e5;
}

.card-title {
    color: #777;
    font-size: 14px;
    margin-bottom: 10px;
}

.card-number {
    font-size: 28px;
    font-weight: bold;
}

.table-box {
    background: white;
    border-radius: 10px;
    overflow-x: auto;
    border: 1px solid #ddd;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
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

.profit {
    color: #176b2c;
    font-weight: bold;
}

.loss {
    color: #c62828;
    font-weight: bold;
}

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

        <a href="profits.php" class="active">💰 Profits</a>

        <a href="discounts.php">🏷️ Discounts</a>

        <a href="users.php">👥 Users</a>

        <a href="helpdesk.php">❓ Help Desk</a>

        <a href="ml_questions.php">🤖 ML Questions</a>

        <a href="../index.php">🌐 View Website</a>

        <a href="login.php" class="logout">🚪 Logout</a>

    </nav>

</aside>


<main class="main">

    <h1>Profit Management</h1>

    <p class="subtitle">
        Track sales, costs and profits.
    </p>


    <div class="stats">

        <div class="card">
            <div class="card-title">Total Sales</div>

            <div class="card-number">
                ₹<?php echo number_format($totalSales, 2); ?>
            </div>
        </div>


        <div class="card">
            <div class="card-title">Total Cost</div>

            <div class="card-number">
                ₹<?php echo number_format($totalCost, 2); ?>
            </div>
        </div>


        <div class="card">
            <div class="card-title">Total Profit</div>

            <div class="card-number profit">
                ₹<?php echo number_format($totalProfit, 2); ?>
            </div>
        </div>


        <div class="card">
            <div class="card-title">Profit Margin</div>

            <div class="card-number">
                <?php echo number_format($profitMargin, 2); ?>%
            </div>
        </div>

    </div>


    <div class="table-box">

        <table>

            <thead>

                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Sales</th>
                    <th>Cost</th>
                    <th>Profit</th>
                </tr>

            </thead>

            <tbody>

            <?php foreach ($profits as $item): ?>

                <?php
                $profit = $item['sales'] - $item['cost'];
                ?>

                <tr>

                    <td>
                        #<?php echo htmlspecialchars($item['order_id']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($item['date']); ?>
                    </td>

                    <td>
                        ₹<?php echo number_format($item['sales'], 2); ?>
                    </td>

                    <td>
                        ₹<?php echo number_format($item['cost'], 2); ?>
                    </td>

                    <td class="<?php echo $profit >= 0 ? 'profit' : 'loss'; ?>">
                        ₹<?php echo number_format($profit, 2); ?>
                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</main>

</body>
</html>