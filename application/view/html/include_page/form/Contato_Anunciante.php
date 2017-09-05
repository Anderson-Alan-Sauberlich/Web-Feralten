<?php use application\view\src\include_page\form\Contato_Anunciante as View_Contato_Anunciante; ?>
<script type="text/javascript" src="/application/view/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form class="ui form" role="form">
    <div class="field">
    	<label>Nome</label>
    	<input type="text" id="nome" name="nome" placeholder="Nome">
    </div>
    <div class="field">
        <label>E-Mail</label>
        <input type="text" id="email" name="email" placeholder="E-Mail">
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
        <textarea rows="4" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
	<button class="ui button fluid inverted red" type="submit">Enviar ao Anunciante</button>
</form>
<script type="text/javascript" src="/application/view/js/include_page/form/contato_anunciante.js"></script>