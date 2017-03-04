<?php require_once RAIZ.'/application/view/src/admin/controle/base_de_conhecimento/cmmv/alterar.php'; ?>
<?php use application\view\src\admin\controle\base_de_conhecimento\cmmv\Alterar as View_Alterar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/admin.php'; ?>
	<script type="text/javascript" src="/application/view/js/admin/controle\base_de_conhecimento\cmmv\alterar.js"></script>
	<title>Alt CMMV | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/admin.php'; ?>
    </header>
    <section class="ui container" role="main">
		<?php View_Alterar::Incluir_Menu_Admin(); ?>
    	<div class="margem-superior-pouco"></div>
	    <div id="div_msg"></div>
		<form class="ui form">
			<h4 class="ui dividing header">Selecione a sequência a ser Alterada:</h4>
			<div class="two fields">
				<div class="field">
					<select id="categoria" name="categoria" class="ui fluid scrolling search selection dropdown">
						<?php View_Alterar::Carregar_Categorias(); ?>
					</select>
				</div>
				<div class="field">
					<select id="marca" name="marca" class="ui fluid scrolling search selection dropdown">
						<option value="0">Marca</option>
					</select>
				</div>
			</div>
			<div class="two fields">
				<div class="field">
					<select id="modelo" name="modelo" class="ui fluid scrolling search selection dropdown">
						<option value="0">Modelo</option>
					</select>
				</div>
				<div class="field">
					<select id="versao" name="versao" class="ui fluid scrolling search selection dropdown">
						<option value="0">Versão</option>
					</select>
				</div>
			</div>
			<h4 class="ui dividing header">Nome e URL da sequência selecionada:</h4>
			<div class="two fields">
				<div class="field">
					<input type="text" id="nome" name="nome" placeholder="Nome (1° Letra Maiuscula)" class="ui fluid"/>
				</div>
				<div class="field">
					<input type="text" id="url" name="url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui fluid"/>
				</div>
			</div>
	    </form>
	    <div class="cmmv_salvar">
	    	<h4 class="ui dividing header">A Alterar: <label class="ui big label" id="lb_item">Nada</label></h4>
	       	<button id="salvar" name="salvar" onclick="SalvarAlterar()" class="ui fluid inverted yellow button ">Salvar e Alterar</button>
	    </div>
    </section>
    <footer>
        <?php //include_once RAIZ.'/application/view/html/include_page/footer/rodape.php'; ?>        
    </footer>
</body>
</html>