<?php use application\view\src\include_page\form\Contato as View_Contato; ?>
<form class="ui form margem-inferior-pouco">
    <div class="field">
    	<label>Nome</label>
    	<input type="text" name="nome" placeholder="Nome">
    </div>
    <div class="field">
        <label>E-Mail</label>
        <input type="text" name="email" placeholder="E-Mail">
    </div>
    <div class="field">
        <label>Telefone</label>
        <input type="text" name="telefone" placeholder="Telefone">
    </div>
    <div class="field">
        <label>Assunto</label>
        <input type="text" name="assunto" placeholder="Assunto">
    </div>
    <div class="field">
        <label>Mensagem</label>
        <textarea rows="4" name="mensagem" placeholder="Mensagem"></textarea>
    </div>
	<button class="ui button fluid inverted red" type="submit">Enviar</button>
</form>