<?php use application\view\src\admin\controle\base_de_conhecimento\cmmv\gerenciar\Alterar as View_Alterar; ?>
<div class="margem-superior-pouco"></div>
<div id="alt_div_msg"></div>
<form class="ui form">
	<h4 class="ui dividing header">Selecione a sequência a ser Alterada:</h4>
	<div class="two fields">
		<div class="field">
			<select id="alt_categoria" name="alt_categoria" class="ui fluid scrolling search selection dropdown">
				<?php View_Alterar::Carregar_Categorias(); ?>
			</select>
		</div>
		<div class="field">
			<select id="alt_marca" name="alt_marca" class="ui fluid scrolling search selection dropdown">
				<option value="0">Marca</option>
			</select>
		</div>
	</div>
	<div class="two fields">
		<div class="field">
			<select id="alt_modelo" name="alt_modelo" class="ui fluid scrolling search selection dropdown">
				<option value="0">Modelo</option>
			</select>
		</div>
		<div class="field">
			<select id="alt_versao" name="alt_versao" class="ui fluid scrolling search selection dropdown">
				<option value="0">Versão</option>
			</select>
		</div>
	</div>
	<h4 class="ui dividing header">Nome e URL da sequência selecionada:</h4>
	<div class="two fields">
		<div class="field">
			<input type="text" id="alt_nome" name="alt_nome" placeholder="Nome (1° Letra Maiuscula)" class="ui fluid"/>
		</div>
		<div class="field">
			<input type="text" id="alt_url" name="alt_url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui fluid"/>
		</div>
	</div>
</form>
<div class="cmmv_salvar">
	<h4 class="ui dividing header">A Alterar: <label class="ui big label" id="alt_lb_item">Nada</label></h4>
   	<button id="alt_salvar" name="alt_salvar" onclick="SalvarAlterar()" class="ui fluid inverted yellow button ">Salvar e Alterar</button>
</div>
<script type="text/javascript" src="/js/admin/controle\base_de_conhecimento\cmmv\gerenciar\alterar.js"></script>