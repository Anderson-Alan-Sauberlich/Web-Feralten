<?php use application\view\src\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/layout/head/Default.php'; ?>
    <title>Início | Feralten</title>
</head>
<body>
    <header>
    	<?php include_once RAIZ.'/application/view/html/layout/header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
    	<form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
        	<?php View_Inicio::Incluir_Menu_Pesquisa(); ?>
        </form>
        
        
            
                <img src="/resources/img/fundo_feralten_s.jpeg" position="center" class="img-responsive centerIMG " />
            	<BR/>
            	<BR/>
            	<BR/>
        
        
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>