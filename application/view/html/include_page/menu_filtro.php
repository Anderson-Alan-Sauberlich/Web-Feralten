<?php require_once RAIZ.'/application/view/src/include_page/menu_filtro.php'; ?>
<?php use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro; ?>
<script type="text/javascript" src="/application/view/js/include_page/menu_filtro.js"></script>
<aside class="row redutorMenuLateral">
	<nav id="menu_filtro" class="ui vertical inverted blue menu">
		<div class="active item"><h3>Filtro de Busca</h3></div>
		<div class="item">
			<div class="header"><h4>Localização</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<select id="estado" name="estado" class="ui fluid search dropdown">
						<option value="0">Selecione o Estado</option>
						<?php View_Menu_Filtro::Mostrar_Estados(); ?>
					</select>
				</div>
			</div>
			<div class="menu">
				<div class="ui container fluid">
					<select id="cidade" name="cidade" class="ui fluid search dropdown">
						<?php View_Menu_Filtro::Mostrar_Cidades(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Ordenar Por</h4></div>
			<div class="menu">
				<div class="ui container fluid">
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
			<div class="header"><h4>Ordenar Pelo Preço</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<div class="row-fluid">
				      	<div class="ui radio checked checkbox">
				        	<input type="radio" name="radio_preco" value="ordenar_menor_preco" id="ordenar_menor_preco">
				        	<label for="ordenar_menor_preco">Menor Preço</label>
				      	</div>
			      	</div>
			      	<div class="row-fluid">
			      		<div class="ui radio checkbox">
			        		<input type="radio" name="radio_preco" value="ordenar_maior_preco" checked="checked" id="ordenar_maior_preco">
			        		<label for="ordenar_maior_preco">Maior Preço</label>
			      		</div>
			      	</div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Preço Entre:</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<div class="ui form">
						<div class="two fields">
							<div class="field">
								<select id="preco_menor" name="preco_menor" class="ui fluid search dropdown">
									<option value="0">Menor</option>
									<?php View_Menu_Filtro::Mostrar_Preco_Menor(); ?>
								</select>
							</div>
							<div class="field">
								<select id="preco_maior" name="preco_maior" class="ui fluid search dropdown">
									<option value="0">Maior</option>
									<?php View_Menu_Filtro::Mostrar_Preco_Maior(); ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Status da Peça</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione o Status</option>
						<?php View_Menu_Filtro::Mostrar_Status(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Data de Publicação</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<div class="row-fluid">
				      	<div class="ui radio checked checkbox">
				        	<input type="radio" name="radio_data" value="ordenar_mais_recente" id="ordenar_mais_recente">
				        	<label for="ordenar_menor_preco">Mais Recente</label>
				      	</div>
			      	</div>
			      	<div class="row-fluid">
			      		<div class="ui radio checkbox">
			        		<input type="radio" name="radio_data" value="ordenar_menos_recente" id="ordenar_menos_recente">
			        		<label for="ordenar_maior_preco">Menos Recente</label>
			      		</div>
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