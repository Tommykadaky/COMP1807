<!-- template/html/build_package.html.php -->
<div style="max-width: 700px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <h2 style="color: #333; border-bottom: 2px solid #0056b3; padding-bottom: 10px; margin-top: 0;">Build Your Own Package</h2>
    <p style="color: #666; margin-bottom: 20px;">Customise your device and plan. Enter a promo code to see your potential savings!</p>

    <!-- Khu vực hiện lỗi của Backend -->
    <?php if (!empty($error_msg)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">
            <?= htmlspecialchars($error_msg) ?>
        </div>
    <?php endif; ?>

    <!-- Khu vực hiện lỗi của JS (khi chọn sai kết hợp) -->
    <div id="js_warning" style="display: none; background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeeba; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">
        Warning message goes here.
    </div>

    <form action="build_package.php" method="POST">
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 8px;">Device Type:</label>
            <select name="device" class="custom-select" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                <option value="None" data-price="0">None (+£0.00)</option>
                <option value="Nokia 3310 (Basic)" data-price="5">Nokia 3310 (Basic) (+£5.00/mo)</option>
                <option value="Samsung Galaxy A54" data-price="15">Samsung Galaxy A54 (+£15.00/mo)</option>
                <option value="Google Pixel 7" data-price="25">Google Pixel 7 (+£25.00/mo)</option>
                <option value="iPhone 15 Pro" data-price="45">iPhone 15 Pro (+£45.00/mo)</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 8px;">Call Minutes:</label>
            <select name="minutes" class="custom-select" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                <option value="100 Mins" data-price="2">100 Mins (+£2.00)</option>
                <option value="300 Mins" data-price="4">300 Mins (+£4.00)</option>
                <option value="500 Mins" data-price="6">500 Mins (+£6.00)</option>
                <option value="1000 Mins" data-price="8">1000 Mins (+£8.00)</option>
                <option value="Unlimited Mins" data-price="12">Unlimited Mins (+£12.00)</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 8px;">Data Allowance:</label>
            <select name="data" class="custom-select" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                <option value="No Data" data-price="0">No Data (+£0.00)</option>
                <option value="2GB" data-price="3">2GB (+£3.00)</option>
                <option value="5GB" data-price="5">5GB (+£5.00)</option>
                <option value="10GB" data-price="8">10GB (+£8.00)</option>
                <option value="50GB" data-price="15">50GB (+£15.00)</option>
                <option value="Unlimited Data" data-price="20">Unlimited Data (+£20.00)</option>
            </select>
        </div>

        <!-- BẢNG TÍNH TIỀN LIVE -->
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; border: 1px dashed #ccc; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; font-weight: bold; color: #555; margin-bottom: 10px;">
                <span>Base Package Cost:</span>
                <span id="display_base_price">£0.00</span>
            </div>
            
            <div id="promo_row" style="display: none; justify-content: space-between; color: #e83e8c; font-weight: bold; margin-bottom: 15px;">
                <span>Potential Savings (<span id="promo_label"></span>):</span>
                <span id="display_promo_discount">- £0.00</span>
            </div>

            <div style="display: flex; justify-content: space-between; border-top: 2px solid #ccc; padding-top: 15px;">
                <span style="font-size: 18px; color: #555; font-weight: bold;">Estimated Monthly Cost:</span>
                <strong id="live_price" style="font-size: 32px; color: #cc0000; line-height: 1;">£0.00</strong>
            </div>
        </div>

        <button type="submit" id="add_custom_btn" name="add_custom" style="background-color: #28a745; color: white; padding: 15px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%; font-size: 18px; transition: background 0.3s;">
            Add Custom Package to Cart
        </button>
    </form>
</div>