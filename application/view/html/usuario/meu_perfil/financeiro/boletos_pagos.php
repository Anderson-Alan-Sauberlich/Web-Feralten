<?php require_once RAIZ.'/application/view/src/usuario/meu_perfil/financeiro/boletos_pagos.php'; ?>
<?php use application\view\src\usuario\meu_perfil\financeiro\Boletos_Pagos as View_Boletos_Pagos; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
	<title>Boletos Pagos | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Boletos_Pagos::Incluir_Menu_Usuario(); ?>
            
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