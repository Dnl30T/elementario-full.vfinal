<?php 
    $show = new showInfo();
    if (isset($_GET['excluir'])) {
        $idExcluir = (int)$_GET['excluir'];
        Painel::deleteTest('avaliacao',$idExcluir);
    }
?>
<div class="box-content">
    <h2><i class="fas fa-address-book"></i> - Nova Avaliação</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>Selecione a escola</label>
                <select name="idInst" id="">
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
                <input type="submit" value="Abrir" name="sendInst" class="btn_form">
            </div>
        </form>
</div>

    <?php 
        if (isset($_POST['sendInst'])) {
        $idInst = $_POST['idInst'];
    ?>
    <div class="box-content">
        <h2><i class="far fa-calendar-alt"></i> - Dados da avaliação</h2>
        <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome-aval" id="nomAval">
        </div>
        
        <label>Tipo:</label>
        <div class="tipo_avali">
            <div class="avali">
                <input type="radio" name="tipo-aval" value="1" id="tipo_aval1"><label for="tipo_aval1">Trabalho</label>
            </div>

            <div class="avali">
                <input type="radio" name="tipo-aval" value="2" id="tipo_aval2"><label for="tipo_aval2">Prova</label>
            </div>

            <div class="avali">
                <input type="radio" name="tipo-aval" value="3" id="tipo_aval3"><label for="tipo_aval3">Teste</label>
            </div>

            <div class="avali">
                <input type="radio" name="tipo-aval" value="4" id="tipo_aval4"><label for="tipo_aval4">Conceito</label>
            </div>

            <div class="avali">
                <input type="radio" name="tipo-aval" value="5" id="tipo_aval5"><label for="tipo_aval5">Outro</label>
            </div>
        </div>
        <div class="form-group">
            <!--TURMA--------------------------------------------------------------------------------------->
            <label>Turma de aplicação:</label>
            <select name="turma-aval" id="">
                <?php
                    $data = $show->showDataFilter("turmas",$idInst,2);
                    foreach ($data as $key => $value) {
                        echo "<option value='".$value['codigo_tur']."'>".$value['nome_tur']."</option>";
                    }
                ?>
            </select>
            <!--/TURMA--------------------------------------------------------------------------------------->
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input type="number" name="valor-aval" id="valor">
        </div>
        <div class="form-group">
            <label>Data de aplicação:</label>
            <input type="date" name="data-aval" id="data">
        </div>
        <div class="form-group">
            <label>Disciplina:</label>
            <select name="disciplina-aval" id="">
                <?php
                    $data = $show->showDataFilter("disciplinas");
                    foreach ($data as $key => $value) {
                        echo "<option value='".$value['codigo_dis']."'>".$value['nome_dis']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Período:</label>
            <select name="periodo-aval" id="">
                <?php
                    $data = modeloSemestral($idInst,1);
                    if ($data != null) {
                        foreach ($data as $key => $value) {
                            echo "<option value='".$key."'>".($key+1).' '.modeloSemestral($idInst)."</option>";
                        }
                    }else{
                        echo "<option value='0'>"."não cadastrado"."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group btn">
            <?php 
            if ($data != null) {
            ?>
            <input type="submit" value="Registrar" name="acao" class="btn_form">
            <?php
            }
            ?>
            <input type="reset" value="Resetar" name="reset" class="btn_form">
        </div>
    </form>
    </div>
    
    <?php
        }
    ?>
    <?php 
        if (isset($_POST['acao'])) {
            $nome = $_POST['nome-aval'];
            //echo $nome."</br>";
            $data = $_POST['data-aval'];
            //echo $data."</br>";
            $disciplina = $_POST['disciplina-aval'];
            //echo $disciplina."</br>";
            $tipo = $_POST['tipo-aval'];
            //echo $tipo."</br>";
            $turma = $_POST['turma-aval'];
            //echo $turma."</br>";
            $periodo = $_POST['periodo-aval'];
            $periodo+=1;
            //echo $periodo."</br>";
            $valor = $_POST['valor-aval'];
            //echo $periodo."</br>";
            if ($nome != null && $disciplina != null && $tipo != null && $turma != null && $periodo != null && $valor != null) {
                $sql = MySql::conectar()->prepare(
                    "INSERT INTO `avaliacao` 
                    (`nome`, `data`, `codigo_ava`, `id_professor`, `disciplina`, `tipo`, `turma`, `periodo`,`valor`,`tem_notas`) 
                    VALUES (?,?,null,?,?,?,?,?,?,0)"
                );
                $sql->execute(array($nome,$data,$_SESSION['ID'],$disciplina,$tipo,$turma,$periodo,$valor));
            }else{
                echo 'faltam informações';
            }
            
        }
    ?>
    <div class="box-content">
        <h2><i class="far fa-calendar-check"></i> - Avaliações Registradas</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>Selecione a escola</label>
                <select name="idTur" id="">
                    <?php
                        $data = $show->showDataFilter("turmas");
                        foreach ($data as $key => $value) {
                            echo "<option value='".$value['codigo_tur']."'>".$value['nome_tur']."</option>";
                        }
                ?>
                <!--<input type="hidden" name="instId" value="<?php echo $value['cod_instituicao']; ?>">-->
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Abrir" name="sendTurList" class="btn_form">
            </div>
        </form>
        <table class="tabela_avaliacoes">
            <?php 
                if (isset($_POST['sendTurList'])) {
                    $numTur = $_POST['idTur'];
                    //$numInst = $_POST['instId'];
                    //echo $numInst."</br>";
            ?>
            <tr>
                <td class="title_ava">Nome</td>
                <td class="title_ava">Data</td>
                <td class="title_ava">Matéria</td>
                <td class="title_ava">Tipo</td>
                <td class="title_ava">Turma</td>
                <td class="title_ava">Período</td>
                <td class="title_ava">Valor</td>
                <td class="title_ava">Remover</td>
            </tr>
            <?php 
                    $turmas = $show->showDataFilter('turmas');
                    foreach ($turmas as $key => $value) {
                        if ($numTur == $value['codigo_tur']) {
                        $numInst = $value['cod_instituicao'];
                        }
                    }
                    /* foreach ($turmas as $key => $value) {
                        echo $value['codigo_tur'].'</br>';
                        echo $value['nome_tur'].'</br>';
                    } */
                    //print_r($turmas);
                    $avaliacoes = Painel::selectAll('avaliacao');
                    $disciplinas = Painel::selectAll('disciplinas');
                    foreach ($avaliacoes as $key => $value) {
                        if ($value['turma'] == $numTur) {
                    //echo $value['turma'].' -> turma</br>';
            ?>
            <tr>
                <td><?php echo $value['nome'].'</br>'; ?></td>
                <td><?php echo $value['data'].'</br>'; ?></td>
                <td>
                    <?php foreach ($disciplinas as $key1 => $value1) {
                            if ($value1['codigo_dis'] == $value['disciplina']) {
                                echo $value1['nome_dis'].'</br>';
                            }
                        }?>
                </td>
                <td><?php getTypeTest($value['tipo'])?></td>
                <td><?php 
                    foreach ($turmas as $key2 => $value2) {
                        //echo $value2['codigo_tur'].'</br>';
                        //echo $value['turma'].'</br>';
                        
                        if ($value2['codigo_tur'] == $value['turma']) {
                            echo $value2['nome_tur'].'</br>';
                        }
                    }
                ?></td>
                <td><?php echo ($value['periodo']).'° '.modeloSemestral($numInst).'</br>'; ?></td>
                <td><?php echo $value['valor'].' pontos'.'</br>'; ?></td>
                <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>avaliacoes?excluir=<?php echo $value['codigo_ava']; ?>">Excluir<i class="fas fa-minus-circle"></i></a></td>
                    <?php
                        //echo $value['disciplina'].'</br>';
                        //echo $value['tipo'].'</br>';
                        //echo $value['turma'].'</br>';
                ?>
                <?php
                        }
                    }
                }
                ?>
            </tr>
        </table>
    </div>
