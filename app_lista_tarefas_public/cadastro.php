<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
    <?php session_start(); ?>

    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1): ?>
        <div id='bg-success' class="bg-success pt-2 text-white d-flex justify-content-center">
            <h5><?= $_SESSION['return_message'] ?></h5>
            <div class="close"></div>
        </div>
    <?php endif ?>
    <main>
        <section id="cadastro-section">
            <div class="cadastro-container">
                <h2>Preencha o formulário para cadastro!</h2>
                <form action="user_controller.php?acao=inserir" method="POST" id="form_cadastro">
                    <div class="input-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" autocomplete="off" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="input-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group" id="conf_password_div">
                        <label for="confirm_password">Confirmação de Senha:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" id='cadastro-btn' class="login-btn">Cadastre-se</button>
                    <div id="error-message"> Por favor, verifique as senhas inseridas e tente novamente</div>
                </form>
                <p class="signup-link">Já possui uma conta? <a href="index.php">Login</a></p>
            </div>


            <svg width="454" height="536" viewBox="0 0 454 536" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="79.2554" y="510.089" width="635" height="377" rx="105.53" transform="rotate(-97.1699 79.2554 510.089)" fill="#656ED3" />
                <rect x="64" y="536" width="635" height="377" rx="105.53" transform="rotate(-90 64 536)" fill="#AFB3FF" />
            </svg>

            <img src="./img/pc.png" alt="">

        </section>
    </main>

</body>
<script>
    $(document).ready(function() {
        $('#error-message').hide();
        $('#form_cadastro').on('submit', function(e) {

            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            console.log(confirmPassword)

            if (password !== confirmPassword) {
                e.preventDefault();
                $('#error-message').show();
            } else {
                $('#error-message').hide();
            }
        });
    });
</script>

</html>