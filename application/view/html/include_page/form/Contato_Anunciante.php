<?php use application\view\src\include_page\form\Contato_Anunciante as View_Contato_Anunciante; ?>
<script type="text/javascript" src="/application/view/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form class="ui form" role="form">
    <div class="field">
    	<label>Nome</label>
    	<input type="text" id="nome" name="nome" placeholder="Nome">
    </div>
    <div class="field">
        <label>E-Mail</label>
        <input type="email" id="email" name="email" placeholder="E-Mail">
    </div>
    <div class="field">
        <label>Telefone</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone">
    </div>
    <div class="field">
    	<div class="ui checkbox">
            <input type="checkbox" id="whats" name="whats">
            <label for="whats">Contato Pelo WhatsApp?</label>
        </div>
    </div>
    <div class="field">
        <label>Mensagem</label>
        <textarea rows="4" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
	<div id="btn_submit" class="ui button fluid inverted red" onclick="Submit();">Enviar ao Anunciante</div>
</form>
<script type="text/javascript" src="/application/view/js/include_page/form/contato_anunciante.js"></script>