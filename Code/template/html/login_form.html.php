<div class="login-container" style="max-width: 400px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px; color: #333;">Login</h2>

    <?php if (isset($error) && !empty($error)): ?>
        <div class="error-msg" style="color: #cc0000; background: #ffe6e6; padding: 10px; border-radius: 4px; text-align: center; margin-bottom: 15px; font-weight: bold;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px; color: #666; font-weight: bold;">Email Address</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; color: #666; font-weight: bold;">Password</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" class="btn-submit" style="width: 100%; padding: 12px; background-color: #d9534f; border: none; color: white; font-size: 16px; border-radius: 4px; cursor: pointer; font-weight: bold;">Sign In</button>
    </form>
</div>