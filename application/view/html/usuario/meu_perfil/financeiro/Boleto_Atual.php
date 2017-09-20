<?php use application\view\src\usuario\meu_perfil\financeiro\Boleto_Atual as View_Boleto_Atual; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/layout/head/Default.php'; ?>
	<title>Boleto Atual | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/layout/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Boleto_Atual::Incluir_Menu_Usuario(); ?>
            
		<div class="container-fluid">
            <div class="row-fluid">
                <img src="/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>