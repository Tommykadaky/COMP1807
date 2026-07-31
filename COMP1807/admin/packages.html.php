<?php include 'header.html.php'; ?>

<div class="main-container">
    <h2><?= $editPackage ? 'Edit Package' : 'Add Package' ?></h2>
    <?php if (!empty($error)): ?><div style="color: #cc0000; background: #ffe6e6; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if (!empty($success)): ?><div style="color: #2b542c; background: #d4edda; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <form method="POST" style="background: #f9f9f9; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
        <input type="hidden" name="id" value="<?= $editPackage['id'] ?? '' ?>">

        <label>Package Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($editPackage['name'] ?? '') ?>" required>

        <label style="margin-top: 10px; display: block;">Original Price ($)</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($editPackage['price'] ?? '') ?>" required>

        <label style="margin-top: 10px; display: block;">Sale Price ($)</label>
        <input type="number" step="0.01" name="sale_price" value="<?= htmlspecialchars($editPackage['sale_price'] ?? '') ?>">

        <label style="margin-top: 10px; display: block;">Sale End Date</label>
        <input type="datetime-local" name="sale_end_date" value="<?= htmlspecialchars($editPackage['sale_end_date'] ?? '') ?>">

        <label style="margin-top: 10px; display: block;">Description</label>
        <textarea name="description" rows="2"><?= htmlspecialchars($editPackage['description'] ?? '') ?></textarea>

        <button type="submit"><?= $editPackage ? 'Update Package' : 'Add Package' ?></button>
        <?php if ($editPackage): ?>
            <a href="packages.php" style="display: block; text-align: center; margin-top: 10px; color: #555; text-decoration: none;">Cancel</a>
        <?php endif; ?>
    </form>

    <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

    <h2>All Packages</h2>
    <div class="table-responsive">
        <table>
            <thead>
                <tr style="background: #f4f4f4;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Sale</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($packages)): ?>
                    <?php foreach ($packages as $pkg): ?>
                        <tr>
                            <td><?= htmlspecialchars($pkg['id']) ?></td>
                            <td><?= htmlspecialchars($pkg['name']) ?></td>
                            <td>$<?= htmlspecialchars($pkg['price']) ?></td>
                            <td><?= isset($pkg['sale_price']) && $pkg['sale_price'] ? '$' . htmlspecialchars($pkg['sale_price']) : 'None' ?></td>
                            <td>
                                <a href="packages.php?edit=<?= $pkg['id'] ?>" style="padding: 4px 8px; background: #f0ad4e; color: white; text-decoration: none; border-radius: 3px; font-size: 12px;">Edit</a>
                                <a href="packages.php?delete=<?= $pkg['id'] ?>" onclick="return confirm('Delete package?');" style="padding: 4px 8px; background: #d9534f; color: white; text-decoration: none; border-radius: 3px; font-size: 12px;">Del</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align: center;">No packages found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div></body></html>