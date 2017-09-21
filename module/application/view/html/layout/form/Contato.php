<?php use module\application\view\src\layout\form\Contato as View_Contato; ?>
<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form id="frm_contato" class="ui form" role="form">
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
    <div id="div_assunto" class="field">
        <label>Assunto</label>
        <input type="text" id="assunto" name="assunto" placeholder="Assunto">
    </div>
    <div id="div_mensagem" class="field">
        <label>Mensagem</label>
        <textarea rows="4" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
	<div id="btn_submit" onclick="Enviar();" class="ui button fluid inverted red">Enviar</div>
</form>
<script type="text/javascript" src="/js/layout/form/contato.js"></script>