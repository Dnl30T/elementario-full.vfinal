<div class="box-content">
    <h2><i class="fas fa-chalkboard-teacher"></i> Turmas</h2>
    <?php
        $mgmt = new Management(); 
        $show = new showInfo();
        if (isset($_GET['excluir'])) {
            $idExcluir = (int)$_GET['excluir'];
            Painel::deleteClass('turmas',$idExcluir);
        }
    ?>
    <!--Alunos-->
    <form action="" method="post">
        <div class="form-group">
            <label>Selecione a escola</label>
            <select name="instituicoes" id="">
                <option></option>
                <?php
                    $data = $show->showDataFilter("instituicao");
                    foreach ($data as $key => $value) {
                        echo "<option value='".$value['codigo_ins']."'>".$value['nome_ins']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
                <input type="submit" value="Mostrar" name="acaoMostrar" class="btn_form">
            </div>
    </form>
    <table class="tabela_aluno">
            <tr>
                <td class="tbl_title">Nome da turma: </td>
                <td class="tbl_title">Excluir</td>
            </tr>    
        <?php 
            if (isset($_POST['acaoMostrar'])) {
        ?>
        <?php
                $instituicoes = $_POST['instituicoes'];
                if ($instituicoes == null) {
                    echo "<b>É nescesária a inserção de uma instituição</b>";
                }
                else{
                $x = $show->showDataFilter(null,$instituicoes,'2'); 
                foreach ($x as $key => $value) {     
        ?>
        <tr>
            <td><?php echo $value['nome_tur'] ?></td>
            <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-turmas?excluir=<?php echo $value['codigo_tur']; ?>"><i class="fas fa-user-times"></i></a></td>
        </tr>
        <?php
                } 
            }
        ?>
        </table>
        <?php
        }else{
        ?>
        <table class="tabela_aluno">
            <?php
                $x = $show->showDataFilter('turmas'); 
                    foreach ($x as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['nome_tur'] ?></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-turmas?excluir=<?php echo $value['codigo_tur']; ?>"><i class="fas fa-user-times"></i></a></td>
                </tr>
            <?php
                }
            ?>
        </table>
        <?php
        }
        ?>
            
    
</div>