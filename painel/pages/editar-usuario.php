<?php
    if (isset($_GET['excluir'])) {
        $idExcluir = (int)$_GET['excluir'];
        Painel::deleteRegister('usuario',$idExcluir);
    }
?>
<div class="box-content">
    <h2><i class="fas fa-users"></i> Administrar Usuários</h2>
    <table class="tabela_aluno">
        <tr>
            <td class="title_ava">Usuario</td>
            <td class="title_ava">Deletar</td>
            <td class="title_ava">Editar</td>
        </tr>
        <?php 
            $show = new showInfo();

            $data = Painel::selectAll('usuario');
            foreach ($data as $key => $value) {
        ?> 
            <tr>
                <td>
                    <?php echo $value['user_usu'];if ($value['tipo_usuario'] == 1) {
                        echo ' - Administrador';
                    }else{
                        echo ' - Professor';
                    } ?>
                </td>
                <td>
                    <a class='btn-delete' href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario?excluir=<?php echo $value['id_usu'] ?>"><i class="fas fa-user-times"></i></a>
                </td>
                <td>
                    <a class='btn-edit' href="<?php echo INCLUDE_PATH_PAINEL ?>info-professor?id=<?php echo $value['id_usu'] ?>"><i class="fas fa-users-cog"></i></a>
                </td>
            </tr>
        <?php
            }
        ?>
        
    </table>
</div>