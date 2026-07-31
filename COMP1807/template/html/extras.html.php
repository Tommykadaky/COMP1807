<!-- template/extras.html.php -->
<div class="packages-header" style="text-align: center; margin-bottom: 30px;">
    <h2>Extra Devices & Add-ons</h2>
    <p>Buy additional standalone phones, tablets, or extra SIM cards here.</p>
    
    <!-- Bộ nút Lọc dành riêng cho Extras -->
    <div class="filters" style="margin: 20px 0;">
        <button class="extra-filter-btn active" data-filter="All" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">All Extras</button>
        <button class="extra-filter-btn" data-filter="Device" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">Devices Only</button>
        <button class="extra-filter-btn" data-filter="Data" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">Data & SIMs</button>
    </div>

    <!-- Thanh Tìm kiếm -->
    <div class="search-box">
        <input type="text" id="extraSearchInput" placeholder="Search extras (e.g., AirPods, SIM)..." style="width: 60%; max-width: 400px; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
    </div>
</div>

<div class="packages-grid" id="extrasGrid">
    <?php if (!empty($extras)): ?>
        <?php foreach ($extras as $item): ?>
            <!-- Gắn data-name và data-type để JS đọc -->
            <div class="extra-card" data-name="<?= strtolower(htmlspecialchars($item['name'])) ?>" data-type="<?= htmlspecialchars($item['type']) ?>">
                <div class="card-header">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <span class="badge" style="background-color: #555555;"><?= htmlspecialchars($item['type']) ?></span>
                </div>
                
                <div class="card-body">
                    <p class="details"><?= htmlspecialchars($item['details']) ?></p>
                    <p class="price">£<?= htmlspecialchars(number_format($item['price'], 2)) ?></p>
                </div>
                
                <div class="card-footer">
                    <form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="extra_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn-select" style="background-color: #555555;">Add to Order</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%; color: #666;">No extra items available at the moment.</p>
    <?php endif; ?>
    
    <!-- Báo lỗi không tìm thấy -->
    <p id="noExtraResultsMsg" style="display: none; text-align: center; width: 100%; color: #cc0000; font-weight: bold; margin-top: 20px;">
        No extra items found matching your search.
    </p>
</div>