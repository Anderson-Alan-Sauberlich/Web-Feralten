<?php use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante; ?>
<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
<form class="ui form" role="form">
    <div id="div_nome" class="field">
        <label>Seu Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Nome">
    </div>
    <div id="div_email" class="field">
        <label>Seu E-Mail</label>
        <input type="email" id="email" name="email" placeholder="E-Mail">
    </div>
    <div id="div_telefone" class="field">
        <label>Seu Telefone</label>
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
        <textarea rows="4" id="mensagem" name="mensagem" placeholder="Mensagem">Olá, tenho interesse nesta peça, gostaria de receber mais informações...</textarea>
    </div>
    <div id="btn_submit" class="ui fluid big teal button" onclick="Submit(<?php View_Contato_Anunciante::Mostrar_Peca_Id(); ?>);">Enviar ao Anunciante</div>
</form>
<script type="text/javascript" src="/application/js/layout/form/contato_anunciante.js"></script>