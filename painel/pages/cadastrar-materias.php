<?php
$sgUp = new signUpManagement();
$showD = new showInfo();
if (isset($_GET['excluir'])) {
    $idExcluir = (int)$_GET['excluir'];
    Painel::deleteSubject('disciplinas', $idExcluir);
}
?>
<div class="box-content">
    <h2><i class="fas fa-shapes"></i> Disciplinas</h2>
    <form action="" method="post">
        <div class="form-group">
            <label>Nome da Disciplina:</label>
            <input type="text" name="name" value="">
        </div>
        <div class="form-group">
            <input type="submit" name="send" value="Enviar" class="btn_form">
        </div>
    </form>
    <table class="tabela_aluno">
        <tr>
            <td class="title_ava">Disciplinas:</td>
            <td class="title_ava">Excluir:</td>
        </tr>
        <?php
        if (isset($_POST['send'])) {
            $sgUp->newSubject($_POST['name']);
        }
        $sql = MySql::conectar()->prepare(
            "SELECT * FROM disciplinas WHERE id_professor = $_SESSION[ID]"
        );
        $sql->execute();
        $show = $sql->fetchAll();
        foreach ($show as $key => $value) {
        ?>
            <tr>
                <td><?php echo $value['nome_dis']; ?></td>
                <td>
                    <a class='btn-delete' href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-materias?excluir=<?php echo $value['codigo_dis'] ?>"><i class="fas fa-times"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>