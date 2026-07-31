<!-- template/html/header.html.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CheapDeals' ?></title>
    
    <!-- Load Global CSS -->
    <link rel="stylesheet" href="template/css/global.css">
    
    <!-- Load Page-Specific CSS -->
    <?php if (isset($cssFile)): ?>
        <link rel="stylesheet" href="<?= $cssFile ?>">
    <?php endif; ?>
</head>
<body>
    <header>
        <!-- Logo on the Left -->
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">CheapDeals</a></h1>
        
        <!-- Navigation on the Right -->
<!-- Cập nhật lại phần <nav> trong header.html.php -->
 <!-- Tìm thẻ <nav> trong header.html.php và cập nhật lại như sau: -->
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                
                <a href="index.php">Home</a>
                <a href="extras.php">Extras</a>
                <a href="build_package.php">Build Package</a>
                
                <!-- Nút News & Offers bôi màu nổi bật -->
                <a href="offers.php" style="color: #ffc107; font-weight: bold;">🎁 Offers</a>
                
                <a href="support.php">Support</a>
                
                <a href="cart.php" style="background-color: #ffc107; color: #000; padding: 5px 12px; border-radius: 4px;">
                    🛒 Cart (<?= $cart_count ?>)
                </a>
                
                <span style="color: #ccc; margin: 0 10px;">|</span>
                
                <a href="account.php" style="font-weight: bold; text-decoration: none; color: #fff; background-color: #0056b3; padding: 5px 15px; border-radius: 20px;">
                    👤 <?= htmlspecialchars($_SESSION['full_name']) ?>
                </a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main>
        <!-- Page content will be injected here -->
        <?= $output ?>
    </main>

    <!-- Load Global JS (Chạy trên mọi trang để giữ vị trí cuộn) -->
    <script src="template/js/global.js"></script>

    <!-- Load Page-Specific JS -->
    <?php if (isset($jsFile)): ?>
        <script src="<?= $jsFile ?>"></script>
    <?php endif; ?>
</body>
</html>