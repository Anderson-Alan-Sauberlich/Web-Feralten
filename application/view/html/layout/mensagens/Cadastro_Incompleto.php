<?php use application\view\src\layout\mensagens\Cadastro_Incompleto; ?>
<div class="ui modal">
	<i class="close icon"></i>
	<div class="header">
		<h4 class="modal-title">Olá <?php Cadastro_Incompleto::Mostrar_Nome(); ?></h4>
		<p><label>Seja bem vindo(a) ao Feralten, sua rede de Ferro Velho na Web</label></p>
	</div>
	<div class="content">
		<p>Para Anunciar suas peças você precisa informar seu Contato e Endereço.</p>
		<p>Por favor, Conclua seu Cadastro: <a href="/usuario/meu-perfil/meus-dados/concluir/">Concluir Cadastro</a></p>
	</div>
  	<div class="actions hidden-xs">
    	<div class="ui black deny button">Cancelar</div>
    	<a href="/usuario/meu-perfil/meus-dados/concluir/">
    		<button class="ui positive right labeled icon button">Ok, Concluir Cadastro<i class="checkmark icon"></i></button>
    	</a>
	</div>
  	<div class="actions visible-xs">
    	<div class="ui black deny button">Cancelar</div>
    	<a href="/usuario/meu-perfil/meus-dados/concluir/">
    		<button class="ui positive right labeled icon button">Concluir<i class="checkmark icon"></i></button>
    	</a>
	</div>
</div>
<script type="text/javascript" src="/application/view/js/layout/mensagens/cadastro_incompleto.js"></script>