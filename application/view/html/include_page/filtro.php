<?php require_once(RAIZ.'/application/view/src/include_page/filtro.php'); ?>
<?php use application\view\src\include_page\Filtro; ?>
<script type="text/javascript" src="/resources/javaScript/menu.js"></script>
<div class="visible-xs">
	<div class="ui sidebar vertical inverted blue menu">
		<div class="item">
			<div class="header">Verção do Modelo</div>
			<div class="menu">
				<div class="container-fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione a Verção</option>
						<option value="1">Standart</option>
						<option value="2">Full</option>
					</select>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="header">Localização</div>
			<div class="menu">
				<div class="container-fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione o Estado</option>
						<option value="1">Santa Catarina</option>
						<option value="2">Rio Grande do Sul</option>
					</select>
				</div>
			</div>
			<div class="menu">
				<div class="container-fluid">
					<select class="ui fluid search dropdown">
						<option value="0">Selecione a Cidade</option>
						<option value="1">Blumenau</option>
						<option value="2">Pomerode</option>
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
						<option value="1">Usado</option>
						<option value="2">Novo</option>
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
	</div>
</div>
<div class="hidden-xs">
	<div class="row redutorMenuLateral">
		<div class="ui fluid sombra_painel vertical inverted blue menu">
			<div class="active item"><b>Filtro de Busca</b></div>
			<div class="item">
				<div class="header">Verção do Modelo</div>
				<div class="menu">
					<div class="container-fluid">
						<select class="ui fluid search dropdown">
							<option value="0">Selecione a Verção</option>
							<option value="1">Standart</option>
							<option value="2">Full</option>
						</select>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="header">Localização</div>
				<div class="menu">
					<div class="container-fluid">
						<select class="ui fluid search dropdown">
							<option value="0">Selecione o Estado</option>
							<option value="1">Santa Catarina</option>
							<option value="2">Rio Grande do Sul</option>
						</select>
					</div>
				</div>
				<div class="menu">
					<div class="container-fluid">
						<select class="ui fluid search dropdown">
							<option value="0">Selecione a Cidade</option>
							<option value="1">Blumenau</option>
							<option value="2">Pomerode</option>
						</select>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="header">Ordenar Por</div>
				<div class="menu">
					<div class="container-fluid">
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Peças Com Fotos</label>
						</div>
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Relevancia</label>
						</div>
						<div class="ui checked checkbox">
							<input name="ordenar_imagem" checked="checked" id="ordenar_imagem" type="checkbox">
							<label>Alta Prioridade</label>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="header">Ordenar Pelo Preço</div>
				<div class="menu">
					<div class="container-fluid">
				      	<div class="ui radio checked checkbox">
				        	<input type="radio" name="radio" id="ordenar_menor_preco">
				        	<label for="ordenar_menor_preco">Menor Preço</label>
				      	</div>
				      	<div class="ui radio checkbox">
				        	<input type="radio" name="radio" checked="checked" id="ordenar_maior_preco">
				        	<label for="ordenar_maior_preco">Maior Preço</label>
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
							<option value="1">Usado</option>
							<option value="2">Novo</option>
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
		</div>
	</div>
</div>