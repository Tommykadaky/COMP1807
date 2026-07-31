<?php include 'header.html.php'; ?>

<div class="main-container">
    <h2>Enquiry Details (ID: <?= htmlspecialchars($enquiry['id']) ?>)</h2>

    <?php if (!empty($success)): ?><div style="color: #2b542c; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px;"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div style="color: #cc0000; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div style="background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #ddd; margin-bottom: 20px;">
        <p style="margin: 5px 0;"><strong>Sender Name:</strong> <?= htmlspecialchars($enquiry['full_name']) ?></p>
        <p style="margin: 5px 0;"><strong>Email:</strong> <?= htmlspecialchars($enquiry['email']) ?></p>
        <p style="margin: 5px 0;"><strong>Subject:</strong> <?= htmlspecialchars($enquiry['subject']) ?></p>
        <p style="margin: 5px 0;"><strong>Status:</strong> <span style="color: <?= $enquiry['status'] === 'Replied' ? '#5cb85c' : '#d9534f' ?>; font-weight: bold;"><?= htmlspecialchars($enquiry['status']) ?></span></p>
        <p style="margin: 5px 0;"><strong>Sent At:</strong> <?= htmlspecialchars($enquiry['created_at']) ?></p>
        
        <hr style="border: 0; border-top: 1px solid #ddd; margin: 15px 0;">
        
        <p style="margin: 0 0 5px 0;"><strong>Message Content:</strong></p>
        <div style="background: #fff; padding: 12px; border: 1px solid #ccc; border-radius: 4px;"><?= nl2br(htmlspecialchars($enquiry['message'])) ?></div>
    </div>

    <!-- Form nhập câu trả lời cho Admin -->
    <form method="POST" style="background: #fafafa; padding: 20px; border-radius: 6px; border: 1px solid #eee;">
        <h3>Reply to User</h3>
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Your Reply</label>
            <textarea name="admin_reply" rows="5" required placeholder="Type your response here..."><?= htmlspecialchars($enquiry['admin_reply'] ?? '') ?></textarea>
        </div>
        <button type="submit">Send Reply</button>
        <a href="support.php" style="display: inline-block; margin-top: 10px; color: #555; text-decoration: none; font-size: 14px;">&larr; Back to Support List</a>
    </form>
</div>

</div></body></html>