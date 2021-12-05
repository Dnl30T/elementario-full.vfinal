<?php
include("classes/Mysql.php");
include("classes/user.php");
include("classes/signUp.php");
?>
<section class="sec sec1">
    <div class="cont-sec image-bg">
        <div class="cx_log color-sec">

            <h1 class="log_title_res">Cadastrar-me</h1>
            <div class="cont-cad-log">
                <div class="cx-cad-log">
                    <form action="" method="POST" class="f_cad_log">
                        <h1>Cadastrar-me:</h1>

                        <div class="inp_cad">
                            <input required type="text" name="nome" placeholder="Nome">
                            <input required type="mail" name="email" placeholder="E-mail" value="<?php if(isset($_POST['redirect'])){$hMail = $_POST['emailR'];echo $hMail;}?>">
                            <input required type="password" name="senha" placeholder="Senha">
                            <input required type="password" name="senhaC" placeholder="Confirme sua senha">
                            <input required type="text" name="usuario" placeholder="crie seu nome de usuário">
                        </div>

                        <div class="inp_btn">
                            <input type="submit" value="Cadastrar" name="acao">
                        </div>

                        <?php
                    if (isset($_POST['acao'])) { 
                        $usuario = new Usuario();
                        $nome = $_POST['nome'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $senhaC = $_POST['senhaC'];
                        $user = $_POST['usuario'];

                        if ($senhaC === $senha) {
                            $check = new Validation();
                            if ($check->strongPassword($senha)) {
                                $sql = MySql::conectar()->query("SELECT * FROM `usuario` WHERE nome_usu = '$user'");
                                $info = $sql->fetch();
                                if($info == true){
                                    echo 'nome de usuário indisponível';
                                }
                                else{
                                    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && $_POST['usuario']){
                                        $usuario->cadastrarUsuario($nome,$email,$senha,$user);
                                        header('Location: '.INCLUDE_PATH_PAINEL);
                                    }else{
                                        echo 'Faltam informações';
                                    }
                                }
                            }
                            
                        }else{
                            echo "senhas não coincidem";
                        }
                        
                        
                    }
                    
                ?>

                    </form>

                </div>
            </div>

            <div class="logo-info">
                <img src="./src/atomo.png">
                <h1>Elementari-o</h1>
                <h2>Sua plataforma de controle de notas.</h2>
            </div>

        </div>
    </div>
</section>