<?php include 'header.html.php'; ?>

<div class="main-container" style="padding: 20px;">
    <h2>Manage Packages</h2>

    <?php if (!empty($success)): ?><div style="color: #2b542c; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px;"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div style="color: #cc0000; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- Form Thêm / Sửa Package -->
    <div style="background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #ddd; margin-bottom: 25px;">
        <h3><?= $editPackage ? 'Edit Package (ID: ' . $editPackage['id'] . ')' : 'Add New Package' ?></h3>
        <form method="POST">
            <?php if ($editPackage): ?>
                <input type="hidden" name="id" value="<?= $editPackage['id'] ?>">
            <?php endif; ?>

            <div style="margin-bottom: 12px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Package Name *</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($editPackage['name'] ?? '') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 12px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Package Type *</label>
                <select name="type" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Select Package Type --</option>
                    <option value="MobileOnly" <?= (isset($editPackage) && $editPackage['type'] === 'MobileOnly') ? 'selected' : '' ?>>MobileOnly</option>
                    <option value="BroadbandOnly" <?= (isset($editPackage) && $editPackage['type'] === 'BroadbandOnly') ? 'selected' : '' ?>>BroadbandOnly</option>
                    <option value="TabletOnly" <?= (isset($editPackage) && $editPackage['type'] === 'TabletOnly') ? 'selected' : '' ?>>TabletOnly</option>
                    <option value="DoublePackage" <?= (isset($editPackage) && $editPackage['type'] === 'DoublePackage') ? 'selected' : '' ?>>DoublePackage (Any 2)</option>
                    <option value="TriplePackage" <?= (isset($editPackage) && $editPackage['type'] === 'TriplePackage') ? 'selected' : '' ?>>TriplePackage (All 3)</option>
                </select>
            </div>

            <div style="margin-bottom: 12px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Price (£) *</label>
                <input type="number" step="0.01" name="price" required value="<?= htmlspecialchars($editPackage['price'] ?? '') ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 12px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Description / Features</label>
                <textarea name="description" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= htmlspecialchars($editPackage['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" style="background: #d9534f; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;"><?= $editPackage ? 'Update Package' : 'Add Package' ?></button>
            <?php if ($editPackage): ?>
                <a href="packages.php" style="margin-left: 10px; text-decoration: none; color: #555;">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Bảng danh sách packages -->
    <h3>Existing Packages</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead>
            <tr style="background: #f2f2f2; text-align: left;">
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($packages)): ?>
                <?php foreach ($packages as $pkg): ?>
                <tr>
                    <td><?= htmlspecialchars($pkg['id']) ?></td>
                    <td><?= htmlspecialchars($pkg['name']) ?></td>
                    <td><strong><?= htmlspecialchars($pkg['type']) ?></strong></td>
                    <td>£<?= number_format($pkg['price'], 2) ?></td>
                    <td><?= htmlspecialchars($pkg['description']) ?></td>
                    <td>
                        <a href="packages.php?edit=<?= $pkg['id'] ?>" style="color: #0275d8; text-decoration: none; margin-right: 10px;">Edit</a>
                        <a href="packages.php?delete=<?= $pkg['id'] ?>" onclick="return confirm('Are you sure you want to delete this package?');" style="color: #d9534f; text-decoration: none;">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align: center;">No packages found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div></body></html>