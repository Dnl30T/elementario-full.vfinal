<div class="box-content">
    <h2><i class="fas fa-school"></i> - Cadastrar Instituição</h2>
    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="name" placeholder="nome da instituição de ensino" required>
        </div>
        <div class="form-group">
            <label>Média:</label>
            <input type="number" name="media" placeholder="media da instituição" min="1" required>
        </div>
        <div class="form-group">
            <label>Modelo Semestral:</label>
            <select name="modSemestral" id="modSem" >
                <option value="1">Mensal(uma média por mês)</option>
                <option value="2">Bimestral(uma média a cada dois meses)</option>
                <option value="3">Trimestral(uma média a cada tres meses)</option>
                <option value="4">1/4(uma média a cada quatro meses)</option>
                <option value="5">1/5(duas médias por ano)</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Atualizar" name="acaoI" class="btn_form">
        </div>

    </form>
    <!------------------------------------------------------------------------------------------------------------->
    <?php
        $newValues = new signUpManagement();
        if (isset($_POST['acaoI'])) {
            $nomeIns = $_POST['name'];
            $mediaIns = $_POST['media'];
            $modSemIns = $_POST['modSemestral'];
            $newValues->newInst($nomeIns,$mediaIns,$modSemIns);
        }
    ?>
    <?php 
    
        $mgmt = new Management();
        $mgmtS = new showInfo();
        if ($mgmt->infoExists("instituicao")) {
    ?>
        <h2><i class="fas fa-chalkboard-teacher"></i> - Cadastrar Turma</h2>
        <form method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" placeholder="sugestão: numero - abreviação (ex: 1101 - ADM)">
            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Selecione a Instituição</label>
                <select name="nome" >
                    <option></option>
                    <?php
                        $data = $mgmtS->showDataFilter("instituicao");
                        foreach ($data as $key => $value) {
                            echo "<option value='".$value['codigo_ins']."'>".$value['nome_ins']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="acaoT" class="btn_form">
            </div>
        </form>
        <!------------------------------------------------------------------------------------------------------------->
        <?php
            if (isset($_POST['acaoT'])) {
                $nomeTur = $_POST['name'];
                $numIns = $_POST['nome'];
                $newValues->newClassroom($nomeTur,$numIns);
            }
        ?>
    <?php 
    } 
    ?>
    <?php
        if ($mgmt->infoExists("turmas")) {
    ?>
        <h2><i class="fas fa-graduation-cap"></i> - Cadastrar Aluno</h2>
        <form method="post" enctype="multipart/form-data">

            <?php
                $signMgmt = new signUpManagement();
                if (isset($_POST['acaoA'])) {
                    $nomeAluno = $_POST['name'];
                    $numAluno = $_POST['number'];
                    $turma = $_POST['turmaAluno'];
                    $signMgmt->newStudent($nomeAluno,$turma,$numAluno);
                }
            ?>

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" placeholder="nome do Aluno">
                <label>Numero:</label>
                <input type="number" name="number" placeholder="numero do aluno(opcional)">

            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Selecione a Turma</label>       
                <select name="turmaAluno" id="">
                    <option></option>
                    <?php
                        $data = $mgmtS->showDataFilter("turmas");
                        foreach ($data as $key => $value) {
                            echo "<option value='".$value['codigo_tur']."'>".$value['nome_tur']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="acaoA" class="btn_form">
            </div>
        </form>
        <!------------------------------------------------------------------------------------------------------------->
    <?php
        }
    ?>
</div>
