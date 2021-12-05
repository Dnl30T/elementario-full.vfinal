<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/atomo.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/painel.css">
    <title>Painel de Controle</title>
</head>

<body>
    <div id="container">
        <div id="painel_cont">
            <aside>
                <div class="menu-wraper">
                    <div class="close_aside_bg">
                        <div class="close_aside">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>

                    <div class="box-usuario">
                        <?php
                        if ($_SESSION['img'] == '') {
                        ?>
                            <div class="avatar-usuario">
                                <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fas fa-atom"></i></a>
                            </div>
                        <?php } else { ?>
                            <div class="imagem-usuario">
                                <a href="<?php echo INCLUDE_PATH_PAINEL ?>">
                                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
                                </a>
                            </div>
                        <?php } ?>
                        <div class="nome-usuario">
                            <p><?php echo $_SESSION['nome'] ?></p>
                            <p><?php if($_SESSION['permission'] == 1){echo 'Administrador';}else{echo 'Professor';}; ?></p>
                            <p>Id da Sessão: <?php echo $_SESSION['ID']; ?></p>
                        </div>
                    </div>
                    <div class="itens-menu">
                        <h2>Cadastro</h2>
                        <a <?php selecionadoMenu('cadastrar-aluno'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar">Cadastrar</a>

                        <h2>Notas</h2>
                        <a <?php selecionadoMenu('notas'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>notas"> Notas</a>
                        <a <?php selecionadoMenu('avaliacoes'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>avaliacoes"> Avaliações</a>

                        <h2>Gestão</h2>
                        <a <?php selecionadoMenu('listar-alunos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-alunos">Listar alunos</a>
                        <a <?php selecionadoMenu('listar-turmas'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-turmas">Listar turmas</a>
                        <a <?php selecionadoMenu('listar-instituicao'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-instituicao">Listar instituicao</a>

                        <h2>Configuração</h2>
                        <a <?php selecionadoMenu('editar-conta'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-conta">Editar Conta</a>
                        <?php if ($_SESSION['permission'] == 1) { ?>
                            <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar usuarios</a>
                        <?php } ?>
                        <a <?php selecionadoMenu('cadastrar-materias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-materias">Disciplinas</a>
                    </div>
                    <!--items-menu-->
                </div>
            </aside>

            <div id="content">
                <header class="painel">
                    <div class="open_aside">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="logout">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout">
                            <span>Sair</span>
                            <i class="fa fa-window-close-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </header>
                <div class="content">
                    <?php Painel::carregarPagina() ?>
                </div>
            </div>
        </div>
    </div>

    <!--<script src="<?php #echo INCLUDE_PATH ?>js/jquery.js"></script>-->
    <script src="<?php #echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>

</html>