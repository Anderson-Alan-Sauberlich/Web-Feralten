<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Perfil as View_Perfil; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php View_Perfil::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
    	<h2 class="ui red dividing header">Olá <?= View_Perfil::RetornarNomeUsuario(); ?>, seja bem vindo(a)!</h2>
        <div class="margem-inferior-minimo"></div>
        <div class="ui stackable four column center aligned grid">
        	<div class="column">
            	<div class="ui tiny orange statistic">
            		<div class="value"><?= View_Perfil::RetornarNumPecas(); ?></div>
            		<div class="label">Peças Cadastradas</div>
            	</div>
        	</div>
        	<div class="column">
            	<div class="ui tiny orange statistic">
            		<div class="value"><?= View_Perfil::RetornarNumLimitePlano(); ?></div>
            		<div class="label">Plano, Limite de Peças</div>
            	</div>
        	</div>
        	<div class="column">
            	<div class="ui tiny orange statistic">
            		<div class="value"><?= View_Perfil::RetornarNumMeusOrcamentos(); ?></div>
            		<div class="label">Meus Orçamentos</div>
            	</div>
        	</div>
        	<div class="column">
            	<div class="ui tiny orange statistic">
            		<div class="value"><?= View_Perfil::RetornarNumOrcamentosRecebidos(); ?></div>
            		<div class="label">Orçamentos Recebidos</div>
            	</div>
        	</div>
        </div>
        <div class="margem-inferior-minimo"></div>
        <div class="ui stackable grid">
        	<div class="three wide column">
        		<?php View_Perfil::Incluir_Menu_Usuario(); ?>
        	</div>
        	<div class="thirteen wide column">
                <h3 class="ui blue dividing header">Peças Visualizadas</h3>
                <div id="div_visualizado" class="ui loading center aligned blue segment">
                    <canvas id="crt_visualizado" width="400" height="125"></canvas>
                </div>
                <div class="margem-inferior-minimo"></div>
                <h3 class="ui green dividing header">Peças Adicionadas</h3>
                <div id="div_adicionado" class="ui loading center aligned green segment">
                    <canvas id="crt_adicionado" width="400" height="125"></canvas>
                </div>
                <div class="margem-inferior-minimo"></div>
                <h3 class="ui red dividing header">Peças Removidas</h3>
                <div id="div_removido" class="ui loading center aligned red segment">
                    <canvas id="crt_removido" width="400" height="125"></canvas>
                </div>
                <div class="margem-inferior-pouco"></div>
        	</div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/resources/packages/chart/chart.bundle.2.7.1.min.js"></script>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/perfil.js"></script>
    </footer>
</body>
</html>