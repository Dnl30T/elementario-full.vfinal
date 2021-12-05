<div class="box-content">
    <h2><i class="fas fa-school"></i> Instituição</h2>
    <?php
        $mgmt = new Management(); 
        $show = new showInfo();
        if (isset($_GET['excluir'])) {
            $idExcluir = (int)$_GET['excluir'];
            Painel::deleteSchool('instituicao',$idExcluir);
        }
    ?>
    <!--Alunos-->
    <table class="tabela_aluno">
        <tr>
            <td class="tbl_title">Nome das instituições: </td>
            <td class="tbl_title">Média da instituição: </td>
            <td class="tbl_title">Paríodo de avaliação</td>
            <td class="tbl_title">Deletar:</td>
        </tr>
        
            <?php 
                    $x = $show->showDataFilter("instituicao"); 
                    foreach ($x as $key => $value) {     
            ?>
            <tr>
                <td><?php echo $value['nome_ins'] ?></td>
                <td><?php echo $value['media'] ?></td>
                <td><?php if($value['modelo-semestral'] == 1){ echo 'bimestre';}else if($value['modelo-semestral'] == 2){ echo 'trimestre';}else{ echo 'indefinido';} ?></td>
                <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-instituicao?excluir=<?php echo $value['codigo_ins']; ?>"><i class="fas fa-user-times"></i></a></td>
            </tr>
            <?php 
                 }
            ?>
        
    </table>
</div>