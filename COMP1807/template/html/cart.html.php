<!-- template/html/cart.html.php -->
<div style="max-width: 900px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <h2 style="color: #333; border-bottom: 2px solid #cc0000; padding-bottom: 10px; margin-top: 0;">Your Shopping Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div style="text-align: center; padding: 50px 0;">
            <p style="font-size: 18px; color: #666;">Your cart is currently empty.</p>
            <a href="index.php" style="background-color: #0056b3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block; margin-top: 15px;">
                Browse Packages
            </a>
        </div>
    <?php else: ?>
        <form action="checkout.php" method="POST" id="cart_form">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                        <th style="padding: 15px; text-align: left; width: 50px;">Buy</th>
                        <th style="padding: 15px; text-align: left;">Package/Deal Name</th>
                        <th style="padding: 15px; text-align: left;">Type</th>
                        <th style="padding: 15px; text-align: right;">Price</th>
                        <th style="padding: 15px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $cart_id => $item): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px; text-align: left;">
                                <input type="checkbox" name="selected_items[]" value="<?= htmlspecialchars($cart_id) ?>" class="item-checkbox" data-price="<?= $item['price'] ?>" checked style="transform: scale(1.5); cursor: pointer;">
                            </td>
                            <td style="padding: 15px; font-weight: bold; color: #333;">
                                <?= htmlspecialchars($item['name']) ?>
                            </td>
                            <td style="padding: 15px; color: #666;">
                                <?= htmlspecialchars($item['type']) ?>
                            </td>
                            <td style="padding: 15px; text-align: right; font-weight: bold;">
                                £<?= number_format($item['price'], 2) ?>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <!-- Link xóa món hàng (chạy lên cart.php ở trên) -->
                                <a href="cart.php?remove=<?= urlencode($cart_id) ?>" style="color: #dc3545; text-decoration: none; font-weight: bold; padding: 5px 10px; border: 1px solid #dc3545; border-radius: 4px;">
                                    Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="margin-top: 20px; padding: 25px; background: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
                <div style="display: flex; gap: 10px; margin-bottom: 10px; max-width: 400px;">
                    <input type="text" id="promo_input" name="promo_code" placeholder="Enter Promo Code (e.g., SALE20)" style="padding: 12px; flex: 1; text-transform: uppercase; border: 1px solid #ccc; border-radius: 4px; font-weight: bold;">
                    <button type="button" id="apply_promo_btn" style="background: #28a745; color: white; border: none; padding: 12px 25px; border-radius: 4px; cursor: pointer; font-weight: bold; transition: background 0.2s;">
                        Apply
                    </button>
                </div>
                
                <div id="promo_message" style="font-size: 14px; margin-bottom: 20px; font-weight: bold; min-height: 20px;"></div>

                <div style="border-top: 2px dashed #ccc; padding-top: 20px; max-width: 400px; margin-left: auto;">
                    <div style="display: flex; justify-content: space-between; font-weight: bold; margin-bottom: 10px; color: #555;">
                        <span>Subtotal (Selected Items):</span>
                        <span id="display_subtotal">£0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: #17a2b8; margin-bottom: 10px; font-weight: bold;">
                        <span>App Exclusive Discount (15%):</span>
                        <span id="display_app_discount">- £0.00</span>
                    </div>
                    <div id="promo_row" style="display: none; justify-content: space-between; color: #e83e8c; margin-bottom: 15px; font-weight: bold;">
                        <span>Promo Discount (<span id="promo_label"></span>):</span>
                        <span id="display_promo_discount">- £0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 22px; border-top: 2px solid #ccc; padding-top: 15px; color: #cc0000;">
                        <span>Final Total:</span>
                        <span id="display_final_total">£0.00</span>
                    </div>
                </div>
            </div>

            <div style="text-align: right; margin-top: 30px;">
                <button type="submit" id="checkout_btn" style="background-color: #cc0000; color: white; padding: 15px 40px; border: none; border-radius: 5px; font-weight: bold; font-size: 18px; cursor: pointer; transition: background 0.3s;">
                    Checkout Selected Items ➔
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>