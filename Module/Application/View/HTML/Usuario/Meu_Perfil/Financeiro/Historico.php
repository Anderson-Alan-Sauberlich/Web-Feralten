<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Historico as View_Historico; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Histórico | Feralten</title>
</head>
<body>
    <header>
        <?php View_Historico::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <div class="ui stackable grid">
        	<div class="three wide column">
        		<?php View_Historico::Incluir_Menu_Usuario(); ?>
        	</div>
        	<div class="thirteen wide column">
        		<h3 class="ui red dividing header">Histórico de Faturas</h3>
                <?php View_Historico::Incluir_Elemento_Fatura(); ?>
                <div class="margem-inferior-pouco"></div>
        	</div>
        </div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/historico.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>