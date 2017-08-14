<?php use application\view\src\pecas\Detalhes as View_Detalhes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<title>Detalhes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
		<h1><?php View_Detalhes::Mostrar_Nome(); ?></h1>
		<h3>Fabricante: <?php View_Detalhes::Mostrar_Fabricante(); ?></h3>
		<h3>Preço: <?php View_Detalhes::Mostrar_Preco(); ?></h3>
		<h3>Estado de Uso: <?php View_Detalhes::Mostrar_Estado_Uso(); ?></h3>
		<h3>Número de Série: <?php View_Detalhes::Mostrar_Serie(); ?></h3>
		<h4>Descrição: <?php View_Detalhes::Mostrar_Descricao(); ?></h4>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>