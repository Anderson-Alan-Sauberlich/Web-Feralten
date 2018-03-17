<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos as View_Meus_Orcamentos; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meus Orçamentos | Feralten</title>
</head>
<body>
    <header>
        <?php View_Meus_Orcamentos::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <div class="ui stackable relaxed grid">
        	<div class="five wide column">
        		<?php View_Meus_Orcamentos::Incluir_Menu_Orcamento(); ?>
            </div>
            <div id="div_orcamentos" class="eleven wide column">
            	<?php View_Meus_Orcamentos::Incluir_Elemento_Orcamento(); ?>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos/meus_orcamentos.js"></script>
    	<script type="text/javascript" src="/application/js/layout/elemento/orcamento.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>