<?php require_once(RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/visualizar.php'); ?>
<?php use application\view\src\usuario\meu_perfil\auto_pecas\Visualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once(RAIZ.'/application/view/html/include_page/head.php'); ?>
    <script type="text/javascript" src="/application/view/js/usuario/meu_perfil/auto_pecas/visualizar.js"></script>
	<title>Visualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once(RAIZ.'/application/view/html/include_page/cabecalho.php'); ?>    
    </header>
    <section class="ui container" role="main">
        <?php include_once(RAIZ.'/application/view/html/include_page/menu_usuario.php'); ?>
		<div class="container-fluid margem-inferior-pouco">
			<div class="row">
				<?php include_once(RAIZ.'/application/view/html/include_page/menu.php'); ?>
				<div class="col-sm-4 col-md-3 col-lg-3">
					<?php include_once(RAIZ.'/application/view/html/include_page/filtro.php'); ?>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					<div class="row">
						<div class="visible-xs">
							<button onclick="abrirFiltro()" class="fluid ui secondary labeled icon open button"><i class="left arrow icon"></i>Abrir Filtro de Busca</button>
							<div class="ui horizontal divider"></div>
						</div>
						<div class="ui three stackable doubling link cards" id="div_pecas">
							<?php Visualizar::Mostrar_Card_Peca(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    <footer>
        <?php include_once(RAIZ.'/application/view/html/include_page/rodape.php'); ?>
    </footer>
</body>
</html>