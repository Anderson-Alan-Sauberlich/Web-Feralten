<?php use application\view\src\layout\form\Contato_Anunciante as View_Contato_Anunciante; ?>
<script type="text/javascript" src="/application/view/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form class="ui form" role="form">
    <div id="div_nome" class="field">
    	<label>Nome</label>
    	<input type="text" id="nome" name="nome" placeholder="Nome">
    </div>
    <div id="div_email" class="field">
        <label>E-Mail</label>
        <input type="email" id="email" name="email" placeholder="E-Mail">
    </div>
    <div id="div_telefone" class="field">
        <label>Telefone</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone">
    </div>
    <div id="div_whatsapp" class="field">
    	<div class="ui checkbox">
            <input type="checkbox" id="whatsapp" name="whatsapp">
            <label for="whatsapp">Contato Pelo WhatsApp?</label>
        </div>
    </div>
    <div id="div_mensagem" class="field">
        <label>Mensagem</label>
        <textarea rows="4" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
	<div id="btn_submit" class="ui button fluid inverted red" onclick="Submit(<?php View_Contato_Anunciante::Mostrar_Peca_Id(); ?>);">Enviar ao Anunciante</div>
</form>
<script type="text/javascript" src="/application/view/js/layout/form/contato_anunciante.js"></script>