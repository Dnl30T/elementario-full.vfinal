<div class="box-content">
    <h2><i class="fa fa-address-book" aria-hidden="true"></i> - Editar conta</h2>
    <form method="post" enctype="multipart/form-data">

        <?php
            if (isset($_POST['acao'])) {
                $usuario = new Usuario();
                $nome = $_POST['name'];
                $email = $_POST['mail'];
                $senha = $_POST['password'];
                $foto = $_FILES['foto'];
                $foto_atual = $_POST['imagem_atual'];

                
                //print_r($foto);
                if ($foto['name'] != '') {
                    if(Painel::imagemValida($foto)){
                        //print_r($foto_atual);
                        Painel::deleteFile($foto_atual);
                        $foto = Painel::uploadFile($foto);
                        if($usuario->atualizarUsuario($nome,$email,$senha,$foto)){
                            Painel::alert('sucesso','foto atualizada com sucesso');
                            $_SESSION['img'] = $foto;
                            header('Location: '.INCLUDE_PATH_PAINEL);
                            //print_r($foto);
                        }else{
                            Painel::alert('erro','ocorreu um erro ao atualizar');
                        }
                    }else{
                        Painel::alert('erro','formato de imagem não suportado');
                    }
                }else{
                    //echo 'foto não selecionada';
                    $foto = $foto_atual;
                    if($usuario->atualizarUsuario($nome,$email,$senha,$foto)){
                        Painel::alert('sucesso','atualizado com sucesso');
                        header('Location: '.INCLUDE_PATH_PAINEL);
                        //print_r($foto);
                    }else{
                        Painel::alert('erro','ocorreu um erro ao atualizar');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="name" value="<?php echo $_SESSION['nome'] ?>">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="mail" name="mail" value="<?php echo $_SESSION['mail'] ?>">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="text" name="password" value="<?php echo $_SESSION['password'] ?>">
        </div>
        <div class="form-group">
            <label>Foto:</label>
            <input type="file" name="foto">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'] ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Atualizar" name="acao" class="btn_form">
        </div>
        
    </form>
</div>