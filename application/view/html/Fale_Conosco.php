<?php use application\view\src\Fale_Conosco as View_Fale_Conosco; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<title>Fale Conosco | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<div class="ui grid">
        	<div class="eleven wide column">
    			<?php View_Fale_Conosco::Incluir_Form_Contato(); ?>
    		</div>
    	</div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>