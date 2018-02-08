<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Nao_Tenho as View_Nao_Tenho; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Não Tenho | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Nao_Tenho::Incluir_Menu_Usuario(); ?>
        <div class="ui stackable relaxed grid">
        	<div class="five wide column">
        		<?php View_Nao_Tenho::Incluir_Menu_Orcamento(); ?>
            </div>
            <div id="div_orcamentos" class="eleven wide column">
            	<?php View_Nao_Tenho::Incluir_Elemento_Orcamento(); ?>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos/nao_tenho.js"></script>
        <script type="text/javascript" src="/application/js/layout/elemento/orcamento.js"></script>
    </footer>
</body>
</html>