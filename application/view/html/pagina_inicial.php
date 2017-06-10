<?php require_once RAIZ.'/application/view/src/pagina_inicial.php'; ?>
<?php use application\view\src\Pagina_Inicial as View_Pagina_Inicial; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head/default.php'; ?>
    <title>Pagina-Inicial | Feralten</title>
</head>
<body>
    <header>
    	<?php include_once RAIZ.'/application/view/html/include_page/header/cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
    	<form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
        	<?php View_Pagina_Inicial::Incluir_Menu_Pesquisa(); ?>
        </form>
        
        <div class="container-fluid">
            <div class="row-fluid">
                <img src="/application/view/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/rodape.php'; ?>
    </footer>
</body>
</html>