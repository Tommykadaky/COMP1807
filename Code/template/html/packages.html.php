<!-- template/html/packages.html.php -->
<div class="packages-header" style="text-align: center; margin-bottom: 30px;">
    <h2>Our Best Packages</h2>
    <p>Find the perfect deal for your needs.</p>
    
    <!-- 1. Bộ nút Lọc (Filter) -->
    <div class="filters" style="margin: 20px 0;">
        <button class="filter-btn active" data-filter="All" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">All</button>
        <button class="filter-btn" data-filter="Combo" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">Combos</button>
        <button class="filter-btn" data-filter="MobileOnly" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">Mobile Only</button>
        <button class="filter-btn" data-filter="BroadbandOnly" style="padding: 8px 15px; margin: 0 5px; cursor: pointer;">Broadband Only</button>
    </div>

    <!-- 2. Thanh Tìm kiếm (Search) -->
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search by name (e.g., Pixel, 5G)..." style="width: 60%; max-width: 400px; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
    </div>
</div>

<div class="packages-grid" id="packagesGrid">
    <?php if (!empty($packages)): ?>
        <?php foreach ($packages as $pkg): ?>
            <!-- ĐÁNH DẤU data-name VÀ data-type ĐỂ LỌC VÀ TÌM KIẾM -->
            <div class="package-card" data-name="<?= strtolower(htmlspecialchars($pkg['name'])) ?>" data-type="<?= htmlspecialchars($pkg['type']) ?>">
                <div class="card-header">
                    <h3><?= htmlspecialchars($pkg['name']) ?></h3>
                    <span class="badge"><?= htmlspecialchars($pkg['type']) ?></span>
                </div>
                
                <div class="card-body">
                    <p class="details"><?= htmlspecialchars($pkg['description'] ?? $pkg['details'] ?? '') ?></p>
                    <p class="price">£<?= htmlspecialchars(number_format($pkg['price'], 2)) ?></p>
                </div>
                
                <div class="card-footer">
                    <form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="package_id" value="<?= $pkg['id'] ?>">
                        <button type="submit" class="btn-select">Select Package</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%; color: #666;">No packages available at the moment.</p>
    <?php endif; ?>
    
    <!-- Dòng thông báo khi không tìm thấy kết quả -->
    <p id="noResultsMsg" style="display: none; text-align: center; width: 100%; color: #cc0000; font-weight: bold; margin-top: 20px;">
        No packages found matching your search.
    </p>
</div>