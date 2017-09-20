<?php use application\view\src\admin\controle\base_de_conhecimento\cmmv\gerenciar\Cadastrar as View_Cadastrar; ?>
<div class="margem-superior-pouco"></div>
<div id="cad_div_msg"></div>
<form class="ui form">
	<h4 class="ui dividing header">Selecione a sequência pertencente a nova informação:</h4>
	<div class="two fields">
		<div class="field">
			<select id="cad_categoria" name="cad_categoria" class="ui fluid scrolling search selection dropdown">
				<?php View_Cadastrar::Carregar_Categorias(); ?>
			</select>
		</div>
		<div class="field">
			<select id="cad_marca" name="cad_marca" class="ui fluid scrolling search selection dropdown">
				<option value="0">Marca</option>
			</select>
		</div>
	</div>
	<div class="two fields">
		<div class="field">
			<select id="cad_modelo" name="cad_modelo" class="ui fluid scrolling search selection dropdown">
				<option value="0">Modelo</option>
			</select>
		</div>
		<div class="field">
			<select id="cad_versao" name="cad_versao" class="ui fluid scrolling search selection dropdown">
				<option value="0">Versão</option>
			</select>
		</div>
	</div>
	<h4 class="ui dividing header">Nome e URL da nova informação:</h4>
	<div class="two fields">
		<div class="field">
			<input type="text" id="cad_nome" name="cad_nome" placeholder="Nome (1° Letra Maiuscula)" class="ui fluid"/>
		</div>
		<div class="field">
			<input type="text" id="cad_url" name="cad_url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui fluid"/>
		</div>
	</div>
</form>
<div class="cmmv_salvar">
	<h4 class="ui dividing header">A Cadastrar: <label class="ui big label" id="cad_lb_item">Categoria</label></h4>
   	<button id="cad_salvar" name="cad_salvar" onclick="SalvarCadastrar()" class="ui fluid inverted green button ">Salvar e Cadastrar</button>
</div>
<script type="text/javascript" src="/js/admin/controle\base_de_conhecimento\cmmv\gerenciar\cadastrar.js"></script>