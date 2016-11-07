<?php require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/visualizar.php'; ?>
<?php use application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
    <script type="text/javascript" src="/application/view/js/usuario/meu_perfil/pecas/visualizar.js"></script>
	<title>Visualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Visualizar::Incluir_Menu_Usuario(); ?>
		<div class="container-fluid margem-inferior-pouco">
			<div class="row">
				<?php View_Visualizar::Incluir_Menu_Pesquisa(); ?>
				<div class="col-sm-4 col-md-3 col-lg-3">
					<?php View_Visualizar::Incluir_Menu_Filtro(); ?>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					<div class="row">
						<div class="ui three stackable doubling link raised cards" id="div_pecas">
							<?php View_Visualizar::Mostrar_Cards_Pecas(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php View_Visualizar::Incluir_Menu_Paginacao(); ?>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/rodape.php'; ?>
    </footer>
</body>
</html>