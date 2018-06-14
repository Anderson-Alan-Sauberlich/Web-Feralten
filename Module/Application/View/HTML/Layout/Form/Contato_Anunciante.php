<?php use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante; ?>
<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form class="ui form" role="form">
    <div id="div_nome" class="field">
        <label for="nome">Seu Nome</label>
        <div class="ui left icon input">
        	<i class="user icon"></i>
        	<input type="text" id="nome" name="nome" value="<?= View_Contato_Anunciante::RetornarUsuarioNome(); ?>" placeholder="Nome">
        </div>
    </div>
    <div id="div_email" class="field">
        <label for="email">Seu E-Mail</label>
        <div class="ui left icon input">
        	<i class="mail icon"></i>
        	<input type="email" id="email" name="email" value="<?= View_Contato_Anunciante::RetornarUsuarioEmail(); ?>" placeholder="E-Mail">
        </div>
    </div>
    <div id="div_telefone" class="field">
        <label for="telefone">Seu Telefone</label>
        <div class="ui left icon input">
        	<i class="tty icon"></i>
        	<input type="text" id="telefone" name="telefone" value="<?= View_Contato_Anunciante::RetornarUsuarioTelefone(); ?>" placeholder="Telefone">
        </div>
    </div>
    <div id="div_whatsapp" class="field">
        <div id="ui_whatsapp" class="ui checkbox">
            <input type="checkbox" id="whatsapp" name="whatsapp">
            <label for="whatsapp">Contato Pelo WhatsApp?</label>
        </div>
    </div>
    <div id="div_mensagem" class="field">
        <label for="mensagem">Mensagem</label>
        <textarea rows="6" id="mensagem" name="mensagem" placeholder="Mensagem">Olá, tenho interesse nesta peça, gostaria de receber mais informações...</textarea>
    </div>
    <div id="btn_submit" class="ui fluid big teal button" onclick="Submit(<?php View_Contato_Anunciante::Mostrar_Peca_Id(); ?>);"><i class="paper plane icon"></i>Enviar ao Anunciante</div>
</form>
<script type="text/javascript" src="/application/js/layout/form/contato_anunciante.js"></script>