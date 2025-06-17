<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify admin privileges
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

// Database connection
require_once 'db_connection.php';

// Get stats for dashboard
try {
    // User count
    $stmt = $pdo->query("SELECT COUNT(*) as user_count FROM users");
    $userCount = $stmt->fetch()['user_count'];
    
    // Product count
    $stmt = $pdo->query("SELECT COUNT(*) as product_count FROM products");
    $productCount = $stmt->fetch()['product_count'];
    
    // Order count
    $stmt = $pdo->query("SELECT COUNT(*) as order_count FROM orders");
    $orderCount = $stmt->fetch()['order_count'];
    
    // Recent orders
    $stmt = $pdo->query("SELECT o.id, u.username as user_name, o.total_amount, o.created_at 
                         FROM orders o JOIN users u ON o.user_id = u.id 
                         ORDER BY o.created_at DESC LIMIT 5");
    $recentOrders = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Failed to load dashboard data: " . $e->getMessage();
    error_log("Dashboard error: " . $e->getMessage());
    $recentOrders = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SK Supplements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'admin_navbar.php'; ?>
    
    <div class="admin-container">
        <h1>Admin Dashboard</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <div class="stats-grid">
            <div class="stat-card bg-primary">
                <i class="fas fa-users"></i>
                <h3><?php echo htmlspecialchars($userCount); ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-card bg-success">
                <i class="fas fa-box-open"></i>
                <h3><?php echo htmlspecialchars($productCount); ?></h3>
                <p>Total Products</p>
            </div>
            <div class="stat-card bg-warning">
                <i class="fas fa-shopping-cart"></i>
                <h3><?php echo htmlspecialchars($orderCount); ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="stat-card bg-info">
                <i class="fas fa-chart-line"></i>
                <h3>LKR <?php 
                    $stmt = $pdo->query("SELECT SUM(total_amount) as revenue FROM orders");
                    echo number_format($stmt->fetch()['revenue'] ?? 0, 2); 
                ?></h3>
                <p>Total Revenue</p>
            </div>
        </div>
        
        <div class="admin-sections">
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td>LKR <?php echo number_format($order['total_amount'], 2); ?></td>
                            <td>
                                <a href="order_details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
            
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="action-grid">
                    <a href="manage_products.php" class="action-card">
                        <i class="fas fa-box-open"></i>
                        <span>Manage Products</span>
                    </a>
                    <a href="manage_users.php" class="action-card">
                        <i class="fas fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                    <a href="add_product.php" class="action-card">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Product</span>
                    </a>
                    <a href="sales_reports.php" class="action-card">
                        <i class="fas fa-chart-pie"></i>
                        <span>Sales Reports</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>