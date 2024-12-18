<?php
session_start();

if (isset($_SESSION['id'])) {
    header('Location: tarefas_pendentes.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php if (isset($_GET['busca']) && $_GET['busca'] == 0) {
        echo 'DEU NAO MAN';
    } ?>
    <main>
        <section id="login-section">
            <div class="login-container">
                <h2>Bem vindo de volta!</h2>
                <form action="user_controller.php?acao=buscar" method="POST">
                    <div class="input-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="login-btn">Login</button>
                </form>
                <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
            </div>

            <div id="purple-bg"></div>

            <svg width="256" height="200" viewBox="0 0 256 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-287" y="392.316" width="596.734" height="141.396" rx="70.698" transform="rotate(-41.1048 -287 392.316)" fill="#838CF1" />
                <rect x="-252" y="375.052" width="553.742" height="131.209" rx="65.6045" transform="rotate(-41.1048 -252 375.052)" fill="#AFB3FF" />
            </svg>

            <img src="./img/agenda.png" alt="">

        </section>
    </main>


</body>

</html>