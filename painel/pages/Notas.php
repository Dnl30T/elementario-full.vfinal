<div class="box-content">
    <h2><i class="fas fa-chart-bar"></i> Dashboard Notas</h2>
        
        <div class="inst_overflow">    
            <div class="lista_intituicoes_bg">
                <?php
                $filter = false;
                    $mgmt = new Management(); 
                    $show = new showInfo();
                    $turmaMostrar = $show->showDataFilter('turmas');
                    $instituicaoMostrar = $show->showDataFilter('instituicao');
                    $materiaMostrar = $show->showDataFilter('disciplinas');
                    $sql = MySql::conectar()->prepare("SELECT * FROM `nota` ORDER BY `periodo`");
                    $sql->execute();
                    $notaMostrar = $sql->fetchAll();
                    $avaliacaoMostrar = Painel::selectAll('avaliacao');
                    $media = 0;
                    $Atual = 1;

                    foreach ($instituicaoMostrar as $key => $value) {

                        #escola
                        ?>
                            <!--Instituição-->
                    <div class="intituicao_item">
                        <details>
                        <?php
                            echo '<summary>'.$value['nome_ins'].'</summary>';
                            foreach ($turmaMostrar as $key2 => $value2) {
                        ?>
                            <?php
                                    #turma

                                    if ($value['codigo_ins'] == $value2['cod_instituicao']) {

                                        echo "<h2 class='nome_turm'>".$value2['nome_tur'].' - '.modeloSemestral($value['codigo_ins']).'</h2>';
                                        $alunoMostrar = $show->showDataFilter('alunos',$value2['codigo_tur'],1);
                                        foreach ($materiaMostrar as $key => $value3) {

                                            #materia
                                            ?>
                                            <details>
                                            <?php
                                            echo "<summary class='nome_materia'>".$value3['nome_dis'].': </summary></br>';
                                            foreach ($alunoMostrar as $key4 => $value4) {

                                                #aluno
                                            ?>
                                            <div class="aluno_sp">
                                            <?php
                                                echo "<span class='nome_aluno_notas'>".$value4['nome_alu']."</span>";
                                                
                                                foreach ($notaMostrar as $key5 => $value5) {

                                                    #nota

                                                    if ($value5['disciplina'] == $value3['codigo_dis']) {
                                                        if ($value4['id_alu'] == $value5['id_aluno']) {
                                                            echo "<p>".($value5['periodo']).' '.modeloSemestral($value['codigo_ins']).'- Nota:'.$value5['valor']."</p>";
                                                            $media += $value5['valor'];
                                                            $Atual=$value5['periodo'];
                                                            foreach ($avaliacaoMostrar as $key => $value6) {

                                                                #avaliação

                                                                if ($value6['disciplina'] == $value3['codigo_dis']) {
                                                                    if ($value6['codigo_ava'] == $value5['id_avaliacao']) {
                                                                        echo "<p>Avaliação: ".$value6['nome'].'</p>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                //echo $media.'</br>';
                                                $mod = count(modeloSemestral($value['codigo_ins'],1));
                                                $MT = round(($media/$mod),1);
                                                echo '<p>media total: '.$MT."</p>";
                                                $MA = round(($media/$Atual),1);
                                                echo '<p>media atual: '.$MA."</p>";
                                                //print_r(array($MA,$MT));
                                                #Insert
                                                if ($value['media'] <= $MT) {
                                                    'já aprovado nessa matéria!';
                                                }
                                                $media = 0;

                                                ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            </details>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        
                            <details>
                        <!--/Instituição-->
                        </div>
                    <?php
                    }
                    ?>

                    
            </div>
        </div>

</div>
<div class="box-content">
    <h2><i class="fas fa-clipboard-check"></i> Cadastrar/Atualizar Notas</h2>
    <form action="" method="post">
            <div class="form-group">
                <label>Selecione a turma</label>
                <select name="turmas" id="">
                    <option></option>
                    <?php
                        $data = $show->showDataFilter("turmas");
                        foreach ($data as $key => $value) {
                            echo "<option value='".$value['codigo_tur']."'>".$value['nome_tur']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                    <input type="submit" value="Abrir" name="acaoMostrar2" class="btn_form">
                </div>
        </form>
        <form action="" method="post">
            <div class="form-group">
                <?php 
                    if (isset($_POST['acaoMostrar2'])) {
                        $turma = $_POST['turmas'];
                        if ($turma == null) {
                        }else if($turma != ''){
                ?>
                <label>Selecione a avaliacao</label>
                <select name="avaliacao-lista" id="">
                    <?php
                            $aval = $show->showDataFilter('avaliacao');
                            foreach ($aval as $key => $value) {
                                if ($value['turma'] == $turma) {
                                    echo "<option value='".$value['codigo_ava']."'>".$value['nome']."</option>";
                                }
                        }
                        echo "<select></select>"
                    ?>
                </select>
                <input type="hidden" name="turma" value="<?php echo $turma; ?>">
                <div class="form-group">
                    <input type="submit" value="Enviar" name="acaoMostrar3" class="btn_form">
                </div>
                <?php
                }else{
                ?>
                <div class="form-group">
                    <input type="submit" value="enviar" name="acaoMostrar3" class="btn_form">
                </div>
                <?php
                    }
                }
                if (isset($_POST['acaoMostrar3']) || isset($_POST['acaoMostrarE'])) {
                    if (@$_POST['avaliacao-lista'] != null) {
                        $name = $_POST['avaliacao-lista'];
                        $turma = $_POST['turma'];
                        //print_r($name);
                        $aval = $show->showDataFilter('avaliacao');
                            foreach ($aval as $key => $value) {
                                if ($value['codigo_ava'] == $name) {
                                    $alunos = $show->showDataFilter('alunos',$turma,1);
                                    foreach ($alunos as $key => $value1) { 
                                    ?>
                                        <label><?php echo $value1['nome_alu'] ?></label>
                                        <input type="number" name="pontuacao[]" step="any" id="" max="<?php  echo $value['valor'] ?>" placeholder="<?php  echo "pontuação máxima: ".$value['valor'] ?>">
                                        <input type="hidden" name="id-aluno[]" value="<?php echo $value1['id_alu'] ?>">
                                        <input type="hidden" name="id-avaliacao[]" value="<?php echo $value['codigo_ava'] ?>">
                                        <input type="hidden" name="disciplina" value="<?php 
                                                $disciplina = $show->showDataFilter('disciplinas');
                                                foreach ($disciplina as $key => $value3) {
                                                    if ($value['disciplina'] == $value3['codigo_dis']) {
                                                        echo $value3['codigo_dis'];
                                                    }
                                                }
                                            ?>">
                                        <input type="hidden" name="id-periodo[]" value="<?php echo $value['periodo'] ?>">
                                        <input type="hidden" name="avaliacao" value="<?php echo $name; ?>">
                                    <?php
                                    }
                                }
                        }
                    }
                ?>
                <div class="form-group">
                    <input type="submit" value="Enviar" name="acaoMostrar4" class="btn_form">
                </div>
                <div class="form-group">
                    <input type="submit" value="Atualizar" name="acaoMostrarE" class="btn_form">
                </div>
                <?php
                }
                if (isset($_POST['acaoMostrar4'])) {
                    $aluno = $_POST['id-aluno'];
                    $pontuacao = $_POST['pontuacao'];
                    $avaliacao = $_POST['id-avaliacao'];
                    $disciplina = $_POST['disciplina'];
                    $periodo = $_POST['id-periodo'];
                    $name = $_POST['avaliacao'];
                    
                    $aval = $show->showDataFilter('avaliacao');
                        foreach ($aval as $key => $value) {
                            if ($value['codigo_ava'] == $name) {
                                /* echo $value['nome'];
                                echo $value['tem_notas']; */
                                $cadastrarNota = $value['tem_notas'];
                            }
                        }
                    for ($i=0; $i < count($aluno); $i++) { 
                            //echo 'cadastrando';
                            if ($cadastrarNota == 0) {
                                $sql = MySql::conectar()->prepare(
                                    "INSERT INTO `nota` (`id_nota`, `id_aluno`, `id_avaliacao`, `disciplina`, `valor`,`periodo`) VALUES (NULL, ?,?,?,?,?)"
                                );
                                $sql->execute(array($aluno[$i],$avaliacao[$i],$disciplina,$pontuacao[$i],$periodo[$i]));
                                $sql = MySql::conectar()->prepare(
                                    "UPDATE `avaliacao` set `tem_notas` = 1 WHERE `codigo_ava` = $avaliacao[$i]"
                                );
                                $sql->execute();
                            }else{

                            }
                            //echo "<meta http-equiv='refresh' content='0'>";
                    }

                    echo "<meta http-equiv='refresh' content='0'>";  
                }else if(isset($_POST['acaoMostrarE'])){
                            $avaliacao = $_POST['id-avaliacao'];
                            $pontuacao = $_POST['pontuacao'];
                            $aluno = $_POST['id-aluno'];
                            $i = 0;
                            echo 'fazendo update </br>';
                            $nota = Painel::selectAll('nota');
                            foreach ($nota as $key => $value) {
                                if ($avaliacao[0] == $value['id_avaliacao']) {
                                    //echo $value['id_avaliacao'];
                                        print_r($avaliacao).' - ';
                                        echo $value['id_aluno'].' - ';
                                        echo $value['id_nota'].' - ';
                                        echo $value['id_avaliacao'].' - ';
                                        echo @$avaliacao[$key].' - ';
                                        echo @$pontuacao[$key].' - '.@$aluno[$key].'</br>';
                                        $sql = MySql::conectar()->prepare(
                                            "UPDATE `nota` SET `valor` = ? WHERE `nota`.`id_nota` = ?"
                                        );
                                        print_r(array($pontuacao[$i],$value['id_nota']));
                                        echo "</br>";
                                        $sql->execute(array($pontuacao[$i],$value['id_nota']));
                                        $i++;
                                } 
                        }
                            //echo $pontuacao[$i].' ';
                    
                   echo "<meta http-equiv='refresh' content='0'>";
                }
                ?>
            </div>
        </form>
</div>