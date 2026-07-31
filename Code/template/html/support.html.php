<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Support Center' ?></title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f9; }
        .container { max-width: 800px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); box-sizing: border-box; }
        h2, h3 { color: #333; margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        button { padding: 12px 20px; background: #0275d8; border: none; color: white; font-size: 15px; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        .alert-success { color: #2b542c; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .alert-error { color: #cc0000; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .enquiry-card { background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px; padding: 15px; margin-bottom: 15px; }
        .enquiry-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; font-size: 13px; color: #666; }
        .status-open { color: #d9534f; font-weight: bold; }
        .status-replied { color: #5cb85c; font-weight: bold; }
        .admin-reply-box { background: #eef9ff; border-left: 4px solid #0275d8; padding: 10px; margin-top: 10px; border-radius: 4px; font-size: 14px; }
        .back-link { display: inline-block; margin-top: 15px; color: #0275d8; text-decoration: none; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Customer Support</h2>
    <p style="font-size: 14px; color: #666;">Need help? Send us a message below or check the status of your previous requests.</p>

    <!-- Thông báo -->
    <?php if (!empty($success)): ?><div class="alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- Form gửi yêu cầu support mới -->
    <form method="POST" style="background: #fafafa; padding: 15px; border-radius: 6px; border: 1px solid #eee; margin-bottom: 30px;">
        <h3>Send New Request</h3>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" required placeholder="Brief description of your issue">
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" rows="4" required placeholder="Describe your problem in detail..."></textarea>
        </div>
        <button type="submit">Submit Request</button>
    </form>

    <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

    <!-- Khu vực hiển thị lịch sử Support History -->
    <h3>Support History & Replies</h3>
    <?php if (!empty($enquiries)): ?>
        <?php foreach ($enquiries as $item): ?>
            <div class="enquiry-card">
                <div class="enquiry-header">
                    <span><strong>Subject:</strong> <?= htmlspecialchars($item['subject']) ?></span>
                    <span class="<?= $item['status'] === 'Replied' ? 'status-replied' : 'status-open' ?>">
                        <?= htmlspecialchars($item['status']) ?>
                    </span>
                </div>
                
                <p style="margin: 5px 0; font-size: 14px; color: #444;">
                    <strong>Your Message:</strong><br>
                    <?= nl2br(htmlspecialchars($item['message'])) ?>
                </p>
                
                <small style="color: #888; font-size: 12px;">Sent at: <?= htmlspecialchars($item['created_at']) ?></small>

                <!-- Hiển thị câu trả lời của Admin nếu có -->
                <?php if (!empty($item['admin_reply'])): ?>
                    <div class="admin-reply-box">
                        <strong>Admin Reply:</strong>
                        <p style="margin: 5px 0; color: #1a1a1a;"><?= nl2br(htmlspecialchars($item['admin_reply'])) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; color: #666; font-size: 14px;">You haven't submitted any support requests yet.</p>
    <?php endif; ?>

    <a href="index.php" class="back-link">&larr; Back to Home</a>
</div>

</body>
</html>