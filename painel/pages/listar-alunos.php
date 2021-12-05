<div class="box-content">
    <h2><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alunos</h2>
    <?php
    $filter = false;
    $canEdit = false;
    if (isset($_GET['excluir'])) {
        $idExcluir = (int)$_GET['excluir'];
        Painel::deleteStudent('alunos', $idExcluir);
    }
    if (isset($_GET['editar'])) {
        $edit = (int)$_GET['editar'];
        $canEdit = true;
    }
    $mgmt = new Management();
    $show = new showInfo();
    ?>
    <!--Alunos-->
    <form action="" method="post">
        <div class="form-group">
            <label>Selecione a turma</label>
            <select name="turmas" id="">
                <option></option>
                <?php
                $data = $show->showDataFilter("turmas");
                foreach ($data as $key => $value) {
                    echo "<option value='" . $value['codigo_tur'] . "'>" . $value['nome_tur'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Mostrar" name="acaoMostrar" class="btn_form">
        </div>
    </form>
    <table class="tabela_aluno">
        <?php
        if (isset($_POST['acaoMostrar'])) {
            $filter = true;
            $turma = $_POST['turmas'];
            if ($turma == null) {
                $filter = false;
            } else {
        ?>
                <tr>
                    <td class="tbl_title">Nome do aluno: </td>
                    <td class="tbl_title">Número: </td>
                    <td class="tbl_title">Deletar: </td>
                    <td class="tbl_title">Editar:</td>
                </tr>
                <?php
                $x = $show->showDataFilter(null, $turma, '1');
                foreach ($x as $key => $value) {
                ?>

                    <tr>
                        <td><?php echo $value['nome_alu'] ?></td>
                        <td><?php echo $value['numero_alu'] ?></td>
                        <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-alunos?excluir=<?php echo $value['id_alu']; ?>"><i class="fas fa-user-times"></i></a></td>
                        <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-alunos?editar=<?php echo $value['id_alu']; ?>"><i class="fas fa-users-cog"></i></a></td>
                    </tr>
        <?php
                }
            }
        } else {
            $filter = false;
        }
        ?>

    </table>
    <?php
    if ($filter == false) {
    ?>
        <table class="tabela_aluno">
            <tr>
                <td class="tbl_title">Nome do aluno: </td>
                <td class="tbl_title">Número: </td>
                <td class="tbl_title">Deletar: </td>
                <td class="tbl_title">Editar:</td>
            </tr>

            <?php
            $x = $show->showDataFilter('alunos', null, null, 'nome_alu');
            foreach ($x as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['nome_alu'] ?></td>
                    <td><?php echo $value['numero_alu'] ?></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-alunos?excluir=<?php echo $value['id_alu']; ?>"><i class="fas fa-user-times"></i></a></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-alunos?editar=<?php echo $value['id_alu']; ?>"><i class="fas fa-users-cog"></i></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <?php
        foreach ($x as $key => $value) {
            /* echo $canEdit.'</br>';
                    echo $value['id_alu'].'</br>';
                    echo $edit; */
            if ($canEdit == true && $value['id_alu'] == $edit) {
        ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Nome do aluno:</label>
                        <input type="text" name="alNom" id="" value="<?php echo $value['nome_alu']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Numero do aluno:</label>
                        <input type="number" name="alNum" id="" value="<?php echo $value['numero_alu']; ?>">
                        <input type="hidden" name="idAlu" id="" value="<?php echo $edit ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updateAl" id="" value="Enviar" class="btn_form">
                    </div>
                </form>
                <?php
                if (isset($_POST['updateAl'])) {
                    $a = $_POST['alNom'];
                    $b = $_POST['alNum'];
                    $c = $_POST['idAlu'];
                    echo $a . '</br>';
                    echo $b . '</br>';
                    echo $c . '</br>';
                    $sql = MySql::conectar()->prepare(
                        "UPDATE `alunos` SET `nome_alu` = ?, `numero_alu` = ? WHERE `alunos`.`id_alu` = ?"
                    );
                    $sql->execute(array($a, $b, $c));
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                ?>

            <?php
            }
            ?>
    <?php
        }
    }
    ?>
</div>