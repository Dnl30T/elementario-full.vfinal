<?php

    class Usuario{
        
        public function atualizarUsuario($nome,$email,$senha,$imagem){
            $sql = Mysql::conectar()->prepare(
                "UPDATE `usuario` 
                SET nome_usu =?, email_usu = ?, senha_usu = ?, img_usu=?
                WHERE user_usu = ?
                ");
            if ($sql->execute(array($nome,$email,$senha,$imagem,$_SESSION['user']))) {
                $_SESSION['nome'] = $nome;
                $_SESSION['mail'] = $email;
                $_SESSION['password'] = $senha;
                return true;
            }
            else{
                return false;
            }
        }
        public function cadastrarUsuario($nome,$email,$senha,$usuario){
            $img = '';
            $sql = Mysql::conectar()->prepare(
                "INSERT INTO `usuario` (nome_usu,email_usu,senha_usu,user_usu,img_usu,id_usu) VALUES (?,?,?,?,?,null)"
            );
            if ($sql->execute(array($nome,$email,$senha,$usuario,$img))) {
                return true;
            }else{
                return false;
            }
        }

    }
    

?>