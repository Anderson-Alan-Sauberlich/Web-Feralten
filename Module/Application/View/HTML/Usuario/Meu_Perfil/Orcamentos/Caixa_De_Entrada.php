<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Caixa_De_Entrada as View_Caixa_De_Entrada; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Caixa de Entrada | Feralten</title>
</head>
<body>
    <header>
        <?php View_Caixa_De_Entrada::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <div class="ui stackable grid">
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
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos/caixa_de_entrada.js"></script>
        <script type="text/javascript" src="/application/js/layout/elemento/orcamento.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>