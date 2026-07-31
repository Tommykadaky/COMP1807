<?php include 'header.html.php'; ?>

<div class="main-container">
    <h2>Support Enquiries</h2>
    <div class="table-responsive">
        <table>
            <thead>
                <tr style="background: #f4f4f4;">
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['id']) ?></td>
                            <td><?= htmlspecialchars($m['user_id']) ?></td>
                            <td><?= htmlspecialchars($m['subject']) ?></td>
                            <td>
                                <strong style="color: <?= ($m['status'] === 'Open') ? '#d9534f' : '#5cb85c' ?>;">
                                    <?= htmlspecialchars($m['status']) ?>
                                </strong>
                            </td>
                            <td><?= htmlspecialchars($m['created_at']) ?></td>
                            <td>
                                <a href="view_enquiry.php?id=<?= $m['id'] ?>" style="padding: 4px 8px; background: #0275d8; color: white; text-decoration: none; border-radius: 3px; font-size: 12px;">View & Reply</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center;">No enquiries found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div></body></html>