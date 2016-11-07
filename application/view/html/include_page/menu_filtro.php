<?php require_once RAIZ.'/application/view/src/include_page/menu_filtro.php'; ?>
<?php use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro; ?>
<script type="text/javascript" src="/application/view/js/include_page/menu_filtro.js"></script>
<aside class="row redutorMenuLateral">
	<nav id="menu_filtro" class="ui vertical inverted blue menu">
		<div class="active item"><b>Filtro de Busca</b></div>
		<div class="item">
			<div class="header">Versão do Modelo</div>
			<div class="menu">
				<div class="container-fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione a Versão</option>
						<?php  ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Localização</div>
			<div class="menu">
				<div class="container-fluid">
					<select id="estado" name="estado" class="ui fluid search dropdown">
						<option value="0">Selecione o Estado</option>
						<?php View_Menu_Filtro::Mostrar_Estados(); ?>
					</select>
				</div>
			</div>
			<div class="menu">
				<div class="container-fluid">
					<select id="cidade" name="cidade" class="ui fluid search dropdown">
						<?php View_Menu_Filtro::Mostrar_Cidades(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Ordenar Por</div>
			<div class="menu">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Peças Com Fotos</label>
						</div>
					</div>
					<div class="row-fluid">
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Relevancia</label>
						</div>
					</div>
					<div class="row-fluid">
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Alta Prioridade</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Ordenar Pelo Preço</div>
			<div class="menu">
				<div class="container-fluid">
					<div class="row-fluid">
				      	<div class="ui radio checked checkbox">
				        	<input type="radio" name="radio" id="ordenar_menor_preco">
				        	<label for="ordenar_menor_preco">Menor Preço</label>
				      	</div>
			      	</div>
			      	<div class="row-fluid">
			      		<div class="ui radio checkbox">
			        		<input type="radio" name="radio" checked="checked" id="ordenar_maior_preco">
			        		<label for="ordenar_maior_preco">Maior Preço</label>
			      		</div>
			      	</div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Status da Peça</div>
			<div class="menu">
				<div class="container-fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione o Status</option>
						<?php View_Menu_Filtro::Mostrar_Status(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Data de Publicação</div>
			<div class="menu">
				<div class="container-fluid">
					<div class="ui fluid disabled input">
						<input placeholder="Data Cadastro" type="text">
					</div>
				</div>
			</div>
		</div>
	</nav>
</aside>
<div class="visible-xs">
	<button onclick="abrirFiltro()" class="fluid ui secondary labeled icon open button"><i class="left arrow icon"></i>Abrir Filtro de Busca</button>
	<div class="ui horizontal divider"></div>
</div>