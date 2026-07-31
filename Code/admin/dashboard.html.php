<?php include 'header.html.php'; ?>

<div class="main-container">
    <h2>Admin Dashboard</h2>
    <p>Welcome back, <strong><?= htmlspecialchars($_SESSION['full_name'] ?? 'Admin') ?></strong>!</p>
    
    <!-- Lưới thống kê co giãn theo màn hình điện thoại -->
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 20px;">
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; border-left: 4px solid #0275d8;">
            <h3 style="margin: 0 0 5px 0; color: #555; font-size: 13px;">Users</h3>
            <p style="font-size: 22px; font-weight: bold; color: #0275d8; margin: 0;"><?= $userCount ?></p>
        </div>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; border-left: 4px solid #5cb85c;">
            <h3 style="margin: 0 0 5px 0; color: #555; font-size: 13px;">Extras</h3>
            <p style="font-size: 22px; font-weight: bold; color: #5cb85c; margin: 0;"><?= $productCount ?></p>
        </div>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; border-left: 4px solid #f0ad4e;">
            <h3 style="margin: 0 0 5px 0; color: #555; font-size: 13px;">Packages</h3>
            <p style="font-size: 22px; font-weight: bold; color: #f0ad4e; margin: 0;"><?= $packageCount ?></p>
        </div>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; border-left: 4px solid #d9534f;">
            <h3 style="margin: 0 0 5px 0; color: #555; font-size: 13px;">Orders</h3>
            <p style="font-size: 22px; font-weight: bold; color: #d9534f; margin: 0;"><?= $orderCount ?></p>
        </div>

    </div>
</div>

</div></body></html>