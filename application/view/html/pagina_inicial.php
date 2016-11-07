<?php require_once RAIZ.'/application/view/src/pagina_inicial.php'; ?>
<?php use application\view\src\Pagina_Inicial as View_Pagina_Inicial; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
    <title>Pagina-Inicial | Feralten</title>
</head>
<body>
    <header>
    	<?php include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Pagina_Inicial::Incluir_Menu_Pesquisa(); ?>
        
        <div class="container-fluid">
            <div class="row-fluid">
                <img src="/application/view/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/rodape.php'; ?>
    </footer>
</body>
</html>