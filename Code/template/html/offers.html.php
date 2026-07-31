<!-- template/html/offers.html.php -->
<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    
    <h2 style="color: #cc0000; border-bottom: 2px solid #cc0000; padding-bottom: 10px; margin-top: 0; font-size: 28px;">
        📰 News & Special Offers
    </h2>
    <p style="color: #666; margin-bottom: 30px; font-size: 16px;">
        Catch up on our latest deals and use these promo codes at checkout to save big!
    </p>

    <!-- Tin tức 1: Chương trình giảm giá App (US-19) -->
    <div style="background: linear-gradient(135deg, #0056b3, #004494); color: white; padding: 30px; border-radius: 10px; margin-bottom: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="background: #ffc107; color: #333; display: inline-block; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px; margin-bottom: 10px;">PROGRAM</div>
            <h3 style="margin: 0 0 10px 0; font-size: 26px;">📱 App Exclusive Discount</h3>
            <p style="margin: 0; font-size: 16px; opacity: 0.9;">Automatically get <strong>15% OFF</strong> on every order when you shop through our platform. No code required!</p>
        </div>
        <div style="font-size: 60px; padding-left: 20px;">✨</div>
    </div>

    <!-- Tin tức 2: Danh sách Mã Giảm Giá -->
    <h3 style="color: #333; margin-bottom: 20px; font-size: 22px;">🎫 Active Promo Codes</h3>
    
    <?php if (empty($active_promos)): ?>
        <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; color: #666; text-align: center; border: 1px dashed #ccc;">
            There are no extra promo codes available at the moment. Please check back later!
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php foreach ($active_promos as $promo): ?>
                <!-- Thẻ Coupon -->
                <div style="background: white; border: 2px dashed #28a745; border-radius: 10px; padding: 25px; text-align: center; position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <div style="background: #28a745; color: white; display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: bold; margin-bottom: 15px; font-size: 14px;">
                        SAVE <?= $promo['discount_percent'] ?>%
                    </div>
                    
                    <h4 style="margin: 0 0 15px 0; font-size: 32px; color: #333; letter-spacing: 2px;">
                        <?= htmlspecialchars($promo['code']) ?>
                    </h4>
                    
                    <p style="color: #666; font-size: 14px; margin-bottom: 20px; background: #f8f9fa; padding: 8px; border-radius: 4px;">
                        <?php if ($promo['expiry_date']): ?>
                            Valid until: <strong><?= date('d M Y, H:i', strtotime($promo['expiry_date'])) ?></strong>
                        <?php else: ?>
                            Valid: <strong>Forever / No Expiry</strong>
                        <?php endif; ?>
                    </p>

                    <!-- Dùng JS nhỏ gọn gắn trực tiếp để copy mã -->
                    <button onclick="navigator.clipboard.writeText('<?= htmlspecialchars($promo['code']) ?>'); alert('Code <?= htmlspecialchars($promo['code']) ?> copied!');" style="background: #f8f9fa; border: 1px solid #ccc; padding: 10px 15px; border-radius: 5px; cursor: pointer; color: #333; font-weight: bold; width: 100%; font-size: 16px; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#e9ecef'" onmouseout="this.style.backgroundColor='#f8f9fa'">
                        Copy Code 📋
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>