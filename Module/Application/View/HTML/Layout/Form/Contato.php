<?php use Module\Application\View\SRC\Layout\Form\Contato as View_Contato; ?>
<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form id="frm_contato" class="ui form" role="form">
    <div id="div_nome" class="field">
        <label for="nome">Nome</label>
        <div class="ui left icon input">
        	<i class="user icon"></i>
        	<input type="text" id="nome" name="nome" value="<?= View_Contato::RetornarUsuarioNome(); ?>" placeholder="Nome">
        </div>
    </div>
    <div id="div_email" class="field">
        <label for="email">E-Mail</label>
        <div class="ui left icon input">
        	<i class="mail icon"></i>
        	<input type="email" id="email" name="email" value="<?= View_Contato::RetornarUsuarioEmail(); ?>" placeholder="E-Mail">
        </div>
    </div>
    <div id="div_telefone" class="field">
        <label for="telefone">Telefone</label>
        <div class="ui left icon input">
        	<i class="tty icon"></i>
        	<input type="text" id="telefone" name="telefone" value="<?= View_Contato::RetornarUsuarioTelefone(); ?>" placeholder="Telefone">
        </div>
    </div>
    <div id="div_whatsapp" class="field">
        <div id="ui_whatsapp" class="ui checkbox">
            <input type="checkbox" id="whatsapp" name="whatsapp">
            <label for="whatsapp">Contato Pelo WhatsApp?</label>
        </div>
    </div>
    <div id="div_assunto" class="field">
        <label for="assunto">Assunto</label>
        <input type="text" id="assunto" name="assunto" placeholder="Assunto">
    </div>
    <div id="div_mensagem" class="field">
        <label for="mensagem">Mensagem</label>
        <textarea rows="4" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
    <div id="btn_submit" onclick="Enviar();" class="ui button fluid inverted red"><i class="paper plane icon"></i>Enviar</div>
</form>
<div id="msg_contato" class="ui hidden message">
	<i class="close icon"></i>
	<ul id="ul_contato"></ul>
</div>
<script type="text/javascript" src="/application/js/layout/form/contato.js"></script>