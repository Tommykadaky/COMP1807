<!-- template/html/checkout.html.php -->
<div style="max-width: 800px; margin: 50px auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center;">
    
    <?php if ($payment_status === 'success'): ?>
        <div style="color: #28a745; font-size: 70px; margin-bottom: 10px; line-height: 1;">✔</div>
        <h2 style="color: #333; font-size: 32px; margin-bottom: 10px;">Payment Successful!</h2>
        
        <div style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px; padding: 25px; text-align: left; margin-bottom: 30px;">
            <h3 style="border-bottom: 2px solid #ccc; padding-bottom: 10px; margin-top: 0; color: #444;">Order Receipt #<?= htmlspecialchars($order_id ?? '') ?></h3>
            
            <ul style="list-style-type: none; padding-left: 0; margin-top: 15px;">
                <?php foreach ($purchased_items as $item): ?>
                    <li style="padding: 12px 0; border-bottom: 1px dashed #ccc; display: flex; justify-content: space-between;">
                        <span style="font-weight: bold;"><?= htmlspecialchars($item['name']) ?></span>
                        <span style="font-weight: bold;">£<?= number_format($item['price'], 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <div style="display: flex; justify-content: space-between; margin-top: 15px; font-size: 15px;">
                <span>Subtotal:</span>
                <span>£<?= number_format($subtotal, 2) ?></span>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 10px; color: #28a745; font-size: 15px;">
                <span>App Exclusive Discount (15%):</span>
                <span>- £<?= number_format($app_discount_amount, 2) ?></span>
            </div>

            <?php if ($promo_discount_amount > 0): ?>
                <div style="display: flex; justify-content: space-between; margin-top: 10px; color: #e83e8c; font-size: 15px;">
                    <span>Promo Code (<?= htmlspecialchars($promo_code_used) ?> - <?= $promo_discount_percent ?>%):</span>
                    <span>- £<?= number_format($promo_discount_amount, 2) ?></span>
                </div>
            <?php endif; ?>

            <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 2px solid #ccc; font-size: 22px; font-weight: bold; color: #cc0000;">
                <span>Total Paid via VISACheck:</span>
                <span>£<?= number_format($final_total, 2) ?></span>
            </div>
        </div>

        <a href="index.php" style="background-color: #0056b3; color: white; padding: 12px 35px; text-decoration: none; border-radius: 5px; font-weight: bold;">Continue Shopping</a>

    <?php else: ?>
        <div style="color: #dc3545; font-size: 70px; margin-bottom: 10px; line-height: 1;">✖</div>
        <h2 style="color: #333; font-size: 32px; margin-bottom: 10px;">Transaction Failed</h2>
        <p style="color: #666; font-size: 18px; margin-bottom: 30px; background: #ffe6e6; padding: 15px; border-radius: 5px;">
            <?= htmlspecialchars($error_message) ?>
        </p>
        <a href="cart.php" style="background-color: #cc0000; color: white; padding: 12px 35px; text-decoration: none; border-radius: 5px; font-weight: bold;">Return to Cart</a>
    <?php endif; ?>
</div>