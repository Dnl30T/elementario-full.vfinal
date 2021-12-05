<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/atomo.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/main.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/cad-log.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/home.css" />
    <title>Painel de controle</title>
</head>

<body>

    <div id="container">

        <header>

            <input type="checkbox" id="checar">

            <a href="<?php echo INCLUDE_PATH; ?>" target="_self">
                <div class="logo">
                    <img src="<?php echo INCLUDE_PATH; ?>/src/atomo.png">
                    <span>Elementari-o</span>
                </div>
            </a>

            <nav>
                <ul class="nav_pages">
                    <a href="<?php echo INCLUDE_PATH; ?>" target="_self">
                        <li>Início</li>
                    </a>

                    <a href="<?php echo INCLUDE_PATH; ?>cadastro" target="_self">
                        <li>Cadastrar</li>
                    </a>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>" target="_self">
                        <li>Login</li>
                    </a>

                    <a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">
                        <li>Contato</li>
                    </a>
                </ul>
            </nav>

            <label for="checar">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </label>
        </header>

        <section class="sec sec1">
            <div class="cont-sec image-bg">
                <div class="cx_log color-sec">

                    <h1 class="log_title_res">Fazer login:</h1>
                    <div class="cont-cad-log">
                        <div class="cx-cad-log">
                            <form action="" method="POST" class="f_cad_log">
                                <h1>Fazer login:</h1>

                                <div class="inp_cad">
                                    <input type="text" name="user" placeholder="Usuário" required>
                                    <input type="password" name="password" placeholder="Senha" required>
                                </div>

                                <div class="inp_btn">
                                    <input type="submit" name="acao" value="Entrar">
                                </div>
                            </form>

                            <?php
                                if (isset($_POST['acao'])) {
                                    $user = $_POST['user'];
                                    $password = $_POST['password'];
                                    $sql = MySql::conectar()->prepare("SELECT * FROM `usuario` WHERE user_usu = ? AND senha_usu = ?");
                                    $sql->execute(array($user, $password));
                                    if ($sql->rowCount() == 1) {
                                        //logamos

                                        $info = $sql->fetch();

                                        $_SESSION['login'] = true;
                                        $_SESSION['user'] = $user;
                                        $_SESSION['password'] = $password;
                                        $_SESSION['nome'] = $info['nome_usu'];
                                        $_SESSION['mail'] = $info['email_usu'];
                                        $_SESSION['img'] = $info['img_usu'];
                                        $_SESSION['ID'] = $info['id_usu'];
                                        $_SESSION['permission'] = $info['tipo_usuario'];
                                        header('Location: ' . INCLUDE_PATH_PAINEL);
                                        die();
                                    } else {
                                        //falho
                                        echo 'usuário ou senha incorretos';
                                    }
                                }
                            ?>

                        </div>
                    </div>

                    <div class="logo-info">
                        <img src="<?php echo INCLUDE_PATH ?>src/atomo.png">
                        <h1>Elementari-o</h1>
                        <h2>Sua plataforma de controle de notas.</h2>
                    </div>

                </div>
            </div>
        </section>

        <footer>
            <p>Elementari-o Ltda. - Todos os Direitos Reservados</p>
            <p>Elementari-o Ltda. - All Rights Reserved</p>
        </footer>
    </div>

</body>

</html>