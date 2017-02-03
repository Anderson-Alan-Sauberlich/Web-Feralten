<?php require_once RAIZ.'/application/view/src/admin/login.php'; ?>
<?php use application\view\src\admin\Login as View_Login; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/admin.php'; ?>
	<script type="text/javascript" src="/application/view/js/admin/login.js"></script>
	<title>Administração | Feralten</title>
</head>
<body>
    <header>
        <?php //include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
    	<div class="margem-superior-medio"></div>
		<div class="ui middle aligned center aligned grid">
		    <form class="ui large form" method="post" action="/admin/login/" role="form">
				<div class="ui stacked segment">
					<div class="field">
						<div class="ui left icon input">
							<i class="user icon"></i>
							<input id="usuario" name="usuario" placeholder="Usuario" type="text">
						</div>
					</div>
					<div class="field">
						<div class="ui left icon input">
							<i class="lock icon"></i>
							<input id="senha" name="senha" placeholder="Senha" type="password">
						</div>
					</div>
					<button class="ui fluid large teal submit button" type="submit">Entrar</button>
				</div>
		    </form>
		</div>
		<div class="margem-superior-medio"></div>
		<?php View_Login::Mostrar_Erros(); ?>
    </section>
    <footer>
        <?php //include_once RAIZ.'/application/view/html/include_page/rodape.php'; ?>        
    </footer>
</body>
</html>