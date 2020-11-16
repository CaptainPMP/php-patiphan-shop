<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <div class="admin-index">
        <div class="container">
            <img src="../img/admin.jpg" alt="">
            <h1>ADMINISTRATOR LOGIN</h1>
            <form action="admin_login.php" method="post">
                <br><br>
                Username: <input type="text" name="adminname" placeholder="Enter username" required>
                <br>
                Password: <input type="password" name="adminpass" placeholder="Enter password" required>
                <br><br>
                <input type="submit" name="admin_login" value="login">
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; Copyright 2020. All Right Reserved MyShop</p>
        </div>
    </footer>

</body>
</html>