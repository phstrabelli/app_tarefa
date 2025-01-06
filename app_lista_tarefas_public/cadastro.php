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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
    <?php session_start(); ?>


    <main>
        <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1): ?>
            <div id='bg-success'>
            </div>
            <div id="msg-success">
                <h5>Usuário cadastrado com sucesso.</h5>
                <div class="close"></div>
            </div>
        <?php endif ?>
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

                    <div class="error-message error-message-password"> Por favor, verifique as senhas inseridas e tente novamente</div>

                    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 0) : ?>
                        <div class="error-message"> <?= $_SESSION['return_message'] ?></div>
                    <?php endif ?>
                </form>

                <form action="user_controller.php?acao=inserir" method="POST" id="form_cadastro_2">
                    <div id="form-step-1">
                        <div class="input-group">
                            <label for="nome_2">Nome:</label>
                            <input type="text" id="nome_2" name="nome" autocomplete="off" required>
                        </div>
                        <div class="input-group">
                            <label for="email_2">Email:</label>
                            <input type="email" id="email_2" name="email" autocomplete="off" required>
                        </div>
                        <button id='next-btn' type="button" class="login-btn">Próximo</button>
                    </div>
                    <div id="form-step-2">
                        <div class="input-group">
                            <label for="username_2">Username:</label>
                            <input type="text" id="username_2" name="username" required>
                        </div>
                        <div class="input-group">
                            <label for="password_2">Senha:</label>
                            <input type="password" id="password_2" name="password" required>
                        </div>
                        <div class="input-group" id="conf_password_div">
                            <label for="confirm_password_2">Confirmação de Senha:</label>
                            <input type="password" id="confirm_password_2" name="confirm_password" required>
                        </div>
                        <div class="btn-group">
                            <button id='prev-btn' class="login-btn">Voltar</button>
                            <button type="submit" id='cadastro-btn-2' class="login-btn">Cadastre-se</button>
                        </div>
                    </div>
                    <div class="error-message error-message-password"> Por favor, verifique as senhas inseridas e tente novamente</div>

                    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 0) : ?>
                        <div class="error-message"> <?= $_SESSION['return_message'] ?></div>
                    <?php endif ?>
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
        screenHeight();

        $('.error-message-password').hide();

        $('#form_cadastro').on('submit', function(e) {

            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                e.preventDefault();
                $('.error-message').hide();
                $('.error-message-password').show();
            } else {
                $('.error-message').hide();
            }
        });

        $('#form_cadastro_2').on('submit', function(e) {

            let password = $('#password_2').val();
            let confirmPassword = $('#confirm_password_2').val();

            if (password !== confirmPassword) {
                e.preventDefault();
                $('.error-message').hide();
                $('.error-message-password').show();
            } else {
                $('.error-message').hide();
            }
        });

        $('#next-btn').on('click', function(e) {

            let nomeInput = $('#nome_2')[0]
            let emailInput = $('#email_2')[0]
            let nome = $('#nome_2').val()
            let email = $('#email_2').val()

            if (nome === '') {
                nomeInput.reportValidity()
            } else if (email === '') {
                emailInput.reportValidity()
            }

            if (nome && email) {

                if (emailInput.reportValidity()) {
                    $('#form-step-1').hide()
                    $('#form-step-2').show()
                }

            }
        })

        $('#prev-btn').on('click', function(e) {
            e.preventDefault()

            $('#form-step-1').show()
            $('#form-step-2').hide()
        })

        $(".close").on("click", () => {
            $("#bg-success").hide();
            $("#msg-success").hide();
        });

        function screenHeight() {
            let screenHeight = $(window).height();

            if (screenHeight < 600) {
                $('#form_cadastro').hide()
                $('#form_cadastro_2').show()
            }
        }
    });
</script>

</html>