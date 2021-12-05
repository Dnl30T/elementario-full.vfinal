<div class="box-content left w100">
        <?php
        $show = new showInfo();
        ?>
        <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>

        <div class="box-metricas">
                <div class="box-metrica-single">
                        <div class="box-metrica-wrapper">
                                <h2>Alunos Totais</h2>
                                <p>
                                        <?php
                                        $studentsLenght = $show->showDataFilter('alunos');
                                        print_r(count($studentsLenght));
                                        ?>
                                </p>
                        </div>
                </div>
                <div class="box-metrica-single">
                        <div class="box-metrica-wrapper">
                                <h2>Turmas Totais</h2>
                                <p>
                                        <?php
                                        $classLenght = $show->showDataFilter('turmas');
                                        print_r(count($classLenght));
                                        ?>
                                </p>
                        </div>
                </div>
                <div class="box-metrica-single">
                        <div class="box-metrica-wrapper">
                                <h2>Instituições Totais</h2>
                                <p>
                                        <?php
                                        $schoolLenght = $show->showDataFilter('instituicao');
                                        print_r(count($schoolLenght));
                                        ?>
                                </p>
                        </div>
                </div>
        </div>

        <div class="elementario">
                <div class="logo-sec">
			<img src="<?php echo INCLUDE_PATH; ?>/src/atomo.png">
			<div class="txt">
                                <h1>Elementari-o</h1>
                                <h2>Sua plataforma de controle de notas.</h2>
                        </div>
		</div>
        </div>
</div>