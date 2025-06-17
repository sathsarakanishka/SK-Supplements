<?php
require_once 'auth_check.php';
require_once 'db_connection.php';

// Only allow admins
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Get sales data
$sales = $pdo->query("
    SELECT DATE(created_at) as date, 
           COUNT(*) as orders, 
           SUM(total_amount) as revenue 
    FROM orders 
    GROUP BY DATE(created_at) 
    ORDER BY date DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'admin_navbar.php'; ?>
    
    <div class="container mt-4">
        <h1>Sales Reports</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5>Daily Sales</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Orders</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= date('M j, Y', strtotime($sale['date'])) ?></td>
                            <td><?= $sale['orders'] ?></td>
                            <td>LKR <?= number_format($sale['revenue'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5>Quick Stats</h5>
                <?php
                $totalRevenue = $pdo->query("SELECT SUM(total_amount) FROM orders")->fetchColumn();
                $totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
                ?>
                <p>Total Revenue: LKR <?= number_format($totalRevenue, 2) ?></p>
                <p>Total Orders: <?= $totalOrders ?></p>
            </div>
        </div>
    </div>
</body>
</html>