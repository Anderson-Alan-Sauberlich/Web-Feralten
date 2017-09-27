<?php use module\application\view\src\usuario\meu_perfil\Perfil as View_Perfil; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Perfil::Incluir_Menu_Usuario(); ?>
        <div id="div_visualizacoes" class="ui loading segment">
        	<canvas id="crt_visualizacoes" width="400" height="125"></canvas>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
        <script type="text/javascript" src="/resources/packages/chart/chart.bundle.2.7.0.min.js"></script>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/perfil.js"></script>
    </footer>
</body>
</html>