<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Caixa_De_Entrada as View_Caixa_De_Entrada; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Caixa de Entrada | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Caixa_De_Entrada::Incluir_Menu_Usuario(); ?>
        <div class="ui stackable relaxed grid">
        	<div class="five wide column">
        		<?php View_Caixa_De_Entrada::Incluir_Menu_Orcamento(); ?>
            </div>
            <div id="div_orcamentos" class="eleven wide column">
            	<?php View_Caixa_De_Entrada::Incluir_Elemento_Orcamento(); ?>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos/caixa_de_entrada.js"></script>
        <script type="text/javascript" src="/application/js/layout/elemento/orcamento.js"></script>
    </footer>
</body>
</html>