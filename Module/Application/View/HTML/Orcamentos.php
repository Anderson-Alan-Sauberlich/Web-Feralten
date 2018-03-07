<?php use Module\Application\View\SRC\Orcamentos as View_Orcamentos; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Orçamentos | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<img class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
    	<h1 class="ui red huge dividing header">Orçamentos Solicitados</h1>
        <div id="div_orcamentos" class="ui text container margem-inferior-pouco">
        	<div class="margem-inferior-minimo"></div>
        	<?php View_Orcamentos::Incluir_Elemento_Orcamento(); ?>
        </div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/orcamentos.js"></script>
    	<script type="text/javascript" src="/application/js/layout/elemento/orcamento.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>