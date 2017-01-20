<?php require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/deletar.php'; ?>
<?php use application\view\src\admin\controle\base_de_conhecimento\cmmv\Deletar as View_Deletar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
	<script type="text/javascript" src="/application/view/js/admin/controle\base_de_conhecimento\cmmv\deletar.js"></script>
	<title>Del CMMV | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/admin.php'; ?>
    </header>
    <section class="ui container" role="main">
		<?php View_Deletar::Incluir_Menu_Admin(); ?>
    	<div class="margem-superior-pouco"></div>
	    <div id="div_msg"></div>
		<form class="ui form">
			<h4 class="ui dividing header">Selecione a sequência a ser Deletada:</h4>
			<div class="two fields">
				<div class="field">
					<select id="categoria" name="categoria" class="ui fluid search selection dropdown">
						<?php View_Deletar::Carregar_Categorias(); ?>
					</select>
				</div>
				<div class="field">
					<select id="marca" name="marca" class="ui fluid search selection dropdown">
						<option value="0">Marca</option>
					</select>
				</div>
			</div>
			<div class="two fields">
				<div class="field">
					<select id="modelo" name="modelo" class="ui fluid search selection dropdown">
						<option value="0">Modelo</option>
					</select>
				</div>
				<div class="field">
					<select id="versao" name="versao" class="ui fluid search selection dropdown">
						<option value="0">Versão</option>
					</select>
				</div>
			</div>
			<h4 class="ui dividing header">Nome e URL da sequência selecionada:</h4>
			<div class="two fields">
				<div class="field">
					<input type="text" id="nome" name="nome" placeholder="Nome (1° Letra Maiuscula)" class="ui disabled fluid"/>
				</div>
				<div class="field">
					<input type="text" id="url" name="url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui disabled fluid"/>
				</div>
			</div>
	    </form>
	    <div class="cmmv_salvar">
	    	<h4 class="ui dividing header">A Deletar: <label class="ui big label" id="lb_item">Nada</label></h4>
	       	<button id="salvar" name="salvar" onclick="SalvarDeletar()" class="ui fluid inverted red button ">Salvar e Deletar</button>
	    </div>
    </section>
    <footer>
        <?php //include_once RAIZ.'/application/view/html/include_page/footer/rodape.php'; ?>        
    </footer>
</body>
</html>