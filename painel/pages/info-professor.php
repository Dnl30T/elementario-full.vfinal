<div class="box-content">
    <h2><i class="fa fa-user" aria-hidden="true"></i> Info-Professor</h2>
    <?php 
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }else{
            Painel::alert('erro','faltou o Id');
        }
        $list = Painel::selectUsersById($id);
        //print_r($list);
    ?>
        <?php
            foreach ($list as $key => $value) {
            $password = password_hash($value['senha_usu'],PASSWORD_DEFAULT);
        ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="newName" id="1-1" value="<?php echo $value['nome_usu'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nome de usuário (atenção! nomes de usuário devem diferir entre si)</label>
                    <input type="text" name="newUser" id="1-2" value="<?php echo $value['user_usu'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Id</label>
                    <input type="number" name="newId" id="1-3" value="<?php echo $value['id_usu'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="mail" name="newMail" id="1-4" value="<?php echo $value['email_usu'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="text" name="newPassWrd" id="1-5" value="<?php echo $password; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tipo (professor=0,Administrador=1)</label>
                    <input type="text" name="newType" id="1-6" value="<?php echo $value['tipo_usuario'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Link de imagem</label>
                    <input type="text" name="newImage" id="1-7" <?php if ($value['img_usu'] == null) {echo "placeholder='não possui imagem'";}else{echo "value='".$value['img_usu']."'";} ?>">
                </div>
                <div class="form-group">
                    <input type="submit" value="atualizar" name="atualizarUser">
                </div>
            </form>
        <?php } ?>
        <?php
            if (isset($_POST['atualizarUser'])) {
                $Name = $_POST['newName'];
                $Username = $_POST['newUser'];
                $Mail = $_POST['newMail'];
                $PassWrd = $_POST['newPassWrd'];
                $Type = $_POST['newType'];
                $Img = $_POST['newImage'];

                $sql = MySql::conectar()->prepare(
                    "UPDATE `usuario` SET `nome_usu` = ?, `email_usu` = ?, `senha_usu` = ?, 
                    `user_usu` = ?, `img_usu` = ?, `tipo_usuario` = ? WHERE `usuario`.`id_usu` = $id"
                );
                $sql->execute(array($Name,$Mail,$PassWrd,$Username,$Img,$Type));
                echo "<meta http-equiv='refresh' content='0'>";
            }
        ?>
</div>