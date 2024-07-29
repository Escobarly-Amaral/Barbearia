<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($_SESSION['message'])){
        echo "<p>{$_SESSION['message']}</p>";
    } ?>
    <form action="" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="register.php">Criar conta</a></p>
</body>
</html>
