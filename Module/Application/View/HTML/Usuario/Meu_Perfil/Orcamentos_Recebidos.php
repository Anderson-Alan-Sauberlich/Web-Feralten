<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos_Recebidos as View_Orcamentos_Recebidos; ?>
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
        <?php View_Orcamentos_Recebidos::Incluir_Menu_Usuario(); ?>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos_recebidos.js"></script>
    </footer>
</body>
</html>