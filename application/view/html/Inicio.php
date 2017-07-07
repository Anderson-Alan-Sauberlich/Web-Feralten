<?php use application\view\src\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
    <title>Início | Feralten</title>
</head>
<body>
    <header>
    	<?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
    	<form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
        	<?php View_Inicio::Incluir_Menu_Pesquisa(); ?>
        </form>
        
        <div class="container-fluid">
            <div class="row-fluid">
                <img src="/application/view/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>