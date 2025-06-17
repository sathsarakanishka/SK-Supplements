<?php
// Check if admin is logged in
$isAdmin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
?>

<nav class="admin-navbar">
    <div class="admin-brand">
        <a href="admin_dashboard.php">SK Supplements Admin</a>
    </div>
    <div class="admin-nav-links">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_products.php">Products</a>
        <a href="manage_users.php">Users</a>
        <a href="sales_reports.php">Reports</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<style>
.admin-navbar {
    background: #343a40;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.admin-brand a {
    color: white;
    font-weight: bold;
    text-decoration: none;
    font-size: 1.2rem;
}
.admin-nav-links a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
}
.admin-nav-links a:hover {
    text-decoration: underline;
}
</style>