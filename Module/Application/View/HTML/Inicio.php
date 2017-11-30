<?php use Module\Application\View\SRC\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Início | Feralten</title>
</head>
<body>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Loader.php'; ?>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <img src="/resources/img/pecas_head.jpg" class="img-responsive headIMG" />
        <form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
            <?php View_Inicio::Incluir_Menu_Pesquisa(); ?>
        </form>
        <img src="/resources/img/fundo_feralten_s.jpeg" class="img-responsive centerIMG" />
        <BR/>
        <BR/>
        <BR/>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>