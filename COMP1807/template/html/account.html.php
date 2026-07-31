<!-- template/html/account.html.php -->
<div style="max-width: 1000px; margin: 40px auto;">
    
    <!-- KHU VỰC NỘI DUNG CHÍNH (2 CỘT) -->
    <div style="display: flex; gap: 30px; margin-bottom: 30px;">
        
        <!-- CỘT TRÁI: EDIT PROFILE -->
        <div style="flex: 1; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <!-- Trả lại tiêu đề sạch sẽ, không kèm nút bấm -->
            <h2 style="color: #cc0000; border-bottom: 2px solid #cc0000; padding-bottom: 10px; margin-top: 0; margin-bottom: 20px;">My Profile</h2>
            
            <?php if (!empty($success_msg)): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?= htmlspecialchars($success_msg) ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($error_msg)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?= htmlspecialchars($error_msg) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="account.php">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email (Cannot be changed)</label>
                    <input type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background-color: #f4f4f4; color: #666; box-sizing: border-box;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Full Name</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Phone Number (UK)</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Address</label>
                    <textarea name="address" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; min-height: 80px;"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

                <button type="submit" name="update_profile" style="background-color: #cc0000; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">
                    Save Changes
                </button>
            </form>
        </div>

        <!-- CỘT PHẢI: LỊCH SỬ ĐƠN HÀNG -->
        <div style="flex: 1; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h2 style="color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-top: 0; margin-bottom: 20px;">Order History</h2>
            
            <?php if (empty($orders)): ?>
                <p style="color: #666;">You haven't placed any orders yet.</p>
            <?php else: ?>
                <ul style="list-style-type: none; padding: 0; margin: 0;">
                    <?php foreach ($orders as $order): ?>
                        <li style="border-bottom: 1px solid #eee; padding: 15px 0;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span style="font-weight: bold; color: #0056b3;">Order #<?= $order['id'] ?></span>
                                <span style="background-color: #28a745; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </div>
                            <div style="color: #666; font-size: 14px; margin-bottom: 5px;">
                                Date: <?= date('d M Y, H:i', strtotime($order['created_at'])) ?>
                            </div>
                            <div style="font-weight: bold; color: #cc0000;">
                                Total: £<?= number_format($order['total_amount'], 2) ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- NÚT LOGOUT TÁCH BIỆT DƯỚI CÙNG -->
    <div style="text-align: right;">
        <a href="logout.php" style="background-color: #6c757d; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#5a6268'" onmouseout="this.style.backgroundColor='#6c757d'">
            Log Out
        </a>
    </div>
</div>