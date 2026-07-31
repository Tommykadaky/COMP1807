<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel - CheapDeals' ?></title>
    <link rel="stylesheet" href="../template/css/style.css">
    <?php if (isset($cssFile)): ?>
        <link rel="stylesheet" href="../<?= $cssFile ?>">
    <?php endif; ?>
    <style>
        /* Tối ưu responsive chung cho Mobile */
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f9; }
        header { background: #333; color: #fff; padding: 12px 15px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; }
        header h2 { font-size: 18px; margin: 0 0 5px 0; }
        nav { display: flex; flex-wrap: wrap; gap: 10px; }
        nav a { color: #fff; text-decoration: none; font-size: 14px; font-weight: bold; }
        .main-container { width: 95%; max-width: 900px; margin: 15px auto; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); box-sizing: border-box; }
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th, td { padding: 8px 10px; font-size: 14px; text-align: left; border: 1px solid #ddd; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px; font-size: 14px; }
        button { width: 100%; padding: 12px; background: #0275d8; border: none; color: white; font-size: 15px; border-radius: 4px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        @media(min-width: 768px) {
            header h2 { margin: 0; }
            .main-container { padding: 25px; margin: 30px auto; }
            button { width: auto; }
        }
    </style>
</head>
<body>
    <header>
        <h2>CheapDeals Admin</h2>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="packages.php">Packages</a>
            <a href="users.php">Users</a>
            <a href="support.php">Support</a>
            <a href="../logout.php" style="color: #ff6b6b;">Logout</a>
        </nav>
    </header>
    <div style="padding: 10px;">