<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($_SESSION['message'])){
        echo "<p>{$_SESSION['message']}</p>";
    } ?>
    <form action="" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrar</button>
    </form>
    <p><a href="login.php">Login</a></p>
</body>
</html>
