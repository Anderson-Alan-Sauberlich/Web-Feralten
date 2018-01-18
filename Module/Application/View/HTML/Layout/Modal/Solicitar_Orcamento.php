<?php use Module\Application\View\SRC\Layout\Modal\Solicitar_Orcamento as View_Solicitar_Orcamento; ?>
<div class="ui container">
	<div class="ui horizontal divider">OU</div>
	<div onclick="abrirModal()" class="ui big yellow button">Solicitar Orçamentos</div>
</div>
<div class="ui fullscreen modal">
	<i class="close icon"></i>
	<div class="content">
		<!--
		verificar se todos osdados estão selecioandos 
		Categoria, Marca, Modelo, Versão, Ano_de/ate, Nome da Peça
		verificar se ta logado
		se estiver então mostra direto o campo pra escrever uma descrição e o botão Enviar para Todos
		se não estiver logado, mostrar pagina com 2 forms, um pra cadastrar, que quando é clicado em cadastrar e o cadastro da certo logo faz o login automatico e mostra a pagina com o campo Descrição e o botão Enviar e se Fiozer só login logo mostrar o form descrição e Enviar
		-->
	</div>
</div>
<script type="text/javascript" src="/application/js/layout/modal/solicitar_orcamento.js"></script>