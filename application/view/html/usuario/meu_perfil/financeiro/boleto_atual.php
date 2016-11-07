<?php require_once RAIZ.'/application/view/src/usuario/meu_perfil/financeiro/boleto_atual.php'; ?>
<?php use application\view\src\usuario\meu_perfil\financeiro\Boleto_Atual as View_Boleto_Atual; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
	<title>Boleto Atual | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Boleto_Atual::Incluir_Menu_Usuario(); ?>
            
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