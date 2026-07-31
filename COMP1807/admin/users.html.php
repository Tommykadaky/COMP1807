<?php include 'header.html.php'; ?>

<div class="main-container">
    <?php if ($editUser): ?>
        <h2>Edit User (ID: <?= htmlspecialchars($editUser['id']) ?>)</h2>
        <?php if (!empty($error)): ?><div style="color: #cc0000; background: #ffe6e6; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if (!empty($success)): ?><div style="color: #2b542c; background: #d4edda; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <form method="POST" style="background: #f9f9f9; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            <label>Full Name</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($editUser['full_name']) ?>" required>
            
            <label style="margin-top: 10px; display: block;">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($editUser['email']) ?>" required>
            
            <label style="margin-top: 10px; display: block;">Phone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($editUser['phone'] ?? '') ?>">
            
            <label style="margin-top: 10px; display: block;">Role</label>
            <select name="role">
                <option value="customer" <?= $editUser['role'] === 'customer' ? 'selected' : '' ?>>Customer</option>
                <option value="admin" <?= $editUser['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
            
            <div style="display: flex; gap: 10px; margin-top: 15px;">
                <button type="submit" style="flex: 1; margin: 0;">Save</button>
                <a href="users.php" style="flex: 1; text-align: center; padding: 12px; background: #6c757d; color: #fff; text-decoration: none; border-radius: 4px; font-size: 15px; font-weight: bold;">Cancel</a>
            </div>
        </form>
        <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">
    <?php endif; ?>

    <h2>Manage Users</h2>
    <div class="table-responsive">
        <table>
            <thead>
                <tr style="background: #f4f4f4;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id']) ?></td>
                            <td><?= htmlspecialchars($u['full_name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['phone']) ?></td>
                            <td><strong><?= htmlspecialchars($u['role']) ?></strong></td>
                            <td>
                                <a href="users.php?edit=<?= $u['id'] ?>" style="padding: 4px 8px; background: #f0ad4e; color: white; text-decoration: none; border-radius: 3px; font-size: 12px;">Edit</a>
                                <a href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?');" style="padding: 4px 8px; background: #d9534f; color: white; text-decoration: none; border-radius: 3px; font-size: 12px;">Del</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center;">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div></body></html>