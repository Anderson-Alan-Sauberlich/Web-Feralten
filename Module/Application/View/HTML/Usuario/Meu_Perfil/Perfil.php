<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Perfil as View_Perfil; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Perfil::Incluir_Menu_Usuario(); ?>
        <div id="div_visualizado" class="ui loading center aligned blue segment">
        	<canvas id="crt_visualizado" width="400" height="125"></canvas>
        </div>
        <div id="div_adicionado" class="ui loading center aligned green segment">
        	<canvas id="crt_adicionado" width="400" height="125"></canvas>
        </div>
        <div id="div_removido" class="ui loading center aligned red segment">
        	<canvas id="crt_removido" width="400" height="125"></canvas>
        </div>
        <div class="ui divider"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/resources/packages/chart/chart.bundle.2.7.0.min.js"></script>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/perfil.js"></script>
    </footer>
</body>
</html>