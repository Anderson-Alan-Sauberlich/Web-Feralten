<?php use Module\Application\View\SRC\Fale_Conosco as View_Fale_Conosco; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Fale Conosco | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<img class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
        <div class="ui grid">
            <div class="eleven wide column">
            	<h1 class="ui red huge dividing header">Fale Conosco</h1>
                <div id="div_contato" class="ui secondary segment">
                    <?php View_Fale_Conosco::Incluir_Form_Contato(); ?>
                </div>
                <div id="msg_contato" class="ui hidden message">
                    <i class="close icon"></i>
                    <ul id="ul_contato"></ul>
                </div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>