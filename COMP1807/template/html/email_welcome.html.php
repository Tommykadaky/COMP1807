<!-- template/email_welcome.html.php -->
<html>
<head>
    <title>Welcome to CheapDeals</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #cc0000;">Hello <?= htmlspecialchars($customer_name) ?>,</h2>
    <p>Welcome to CheapDeals! Your account has been successfully created.</p>
    <p>You can now log in to explore our packages.</p>
    <br>
    <a href="<?= htmlspecialchars($login_link) ?>" style="background-color: #cc0000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Click here to login</a>
</body>
</html>