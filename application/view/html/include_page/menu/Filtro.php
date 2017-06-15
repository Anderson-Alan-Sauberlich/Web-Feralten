<?php use application\view\src\include_page\menu\Filtro as View_Filtro; ?>
<aside class="row redutorMenuLateral">
	<nav id="menu_filtro" class="ui vertical inverted blue fluid sombra_painel menu">
		<div class="active item">
			<div class="ui grid">
				<div class="eleven wide column">
					<h3>Filtro de Busca</h3>
				</div>
				<div class="one wide column">
					<button onClick="Pesquisar()" class="ui inverted icon button"><i class="refresh icon"></i></button>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Localização</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<select id="estado" name="estado" class="ui fluid scrolling search dropdown">
						<option value="0">Selecione o Estado</option>
						<?php View_Filtro::Mostrar_Estados(); ?>
					</select>
				</div>
			</div>
			<div class="menu">
				<div class="ui container fluid">
					<select id="cidade" name="cidade" class="ui fluid scrolling search dropdown">
						<?php View_Filtro::Mostrar_Cidades(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Ordenar Pelo Preço</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<div class="row-fluid">
				      	<div class="ui radio checkbox">
				        	<input type="radio" name="ordem_preco" value="por_menor" <?php View_Filtro::Manter_Valor('ordem_preco', 'por_menor'); ?> id="ordenar_menor_preco">
				        	<label for="ordenar_menor_preco">Menor Preço</label>
				      	</div>
			      	</div>
			      	<div class="row-fluid">
			      		<div class="ui radio checkbox">
			        		<input type="radio" name="ordem_preco" value="por_maior" <?php View_Filtro::Manter_Valor('ordem_preco', 'por_maior'); ?> id="ordenar_maior_preco">
			        		<label for="ordenar_maior_preco">Maior Preço</label>
			      		</div>
			      	</div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Status da Peça</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<select id="status" name="status" class="ui fluid search dropdown">
						<option value="0">Selecione o Status</option>
						<?php View_Filtro::Mostrar_Status(); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header"><h4>Data de Publicação</h4></div>
			<div class="menu">
				<div class="ui container fluid">
					<div class="row-fluid">
				      	<div class="ui radio checkbox">
				        	<input type="radio" name="ordem_data" value="mais_recente" <?php View_Filtro::Manter_Valor('ordem_data', 'mais_recente'); ?> id="ordenar_mais_recente">
				        	<label for="ordenar_mais_recente">Mais Recente</label>
				      	</div>
			      	</div>
			      	<div class="row-fluid">
			      		<div class="ui radio checkbox">
			        		<input type="radio" name="ordem_data" value="menos_recente" <?php View_Filtro::Manter_Valor('ordem_data', 'menos_recente'); ?> id="ordenar_menos_recente">
			        		<label for="ordenar_menos_recente">Menos Recente</label>
			      		</div>
			      	</div>
				</div>
			</div>
		</div>
		<div class="item">
			<button onClick="Pesquisar()" class="ui fluid inverted large icon button"><i class="refresh icon"></i> Atualizar</button>
		</div>
	</nav>
</aside>
<div class="visible-xs">
	<button onclick="abrirFiltro()" class="fluid ui secondary labeled icon open button"><i class="left arrow icon"></i>Abrir Filtro de Busca</button>
	<div class="ui horizontal divider"></div>
</div>
<script type="text/javascript" src="/application/view/js/include_page/menu/filtro.js"></script>