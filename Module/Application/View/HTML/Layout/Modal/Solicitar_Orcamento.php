<?php use Module\Application\View\SRC\Layout\Modal\Solicitar_Orcamento as View_Solicitar_Orcamento; ?>
<div class="ui container">
	<div class="ui horizontal divider">OU</div>
	<div onclick="abrirModal()" class="ui big yellow button">Solicitar Orçamentos</div>
</div>
<div id="mdl_enviar" class="ui mini modal">
	<i class="close icon"></i>
	<div class="header">Preencha os campos obrigatórios:</div>
    <ul id="mdl_content" class="inverted list"></ul>
    <div class="actions">
        <div class="ui approve right labeled icon button">Continuar <i class="checkmark icon"></i></div>
    </div>
</div>
<div class="ui large long modal">
	<i class="close icon"></i>
	<div class="content">
		<?php if (!View_Solicitar_Orcamento::Verificar_Logado()) { ?>
        	<div id="div_autenticacao" class="ui two column relaxed stackable internally celled grid">
        		<div class="column">
                    <div class="ui equal width form">
                    	<h2 class="ui dividing header">Criar Cadastro</h2>
                        <div class="fields">
                        	<div class="field">
                           		<label>Digite seu nome:</label>
                           		<input name="first-name" placeholder="Nome" type="text">
                           	</div>
                           	<div class="field">
                           		<label>Digite seu sobrenome:</label>
                           		<input name="last-name" placeholder="Sobrenome" type="text">
                        	</div>
                        </div>
                    	<div class="field">
                    		<div class="field">
                           		<label>Digite seu E-Mail:</label>
                           		<input name="last-name" placeholder="E-Mail" type="email">
                        	</div>
                    	</div>
                    	<div class="field">
                    		<div class="field">
                           		<label>Cire uma senha:</label>
                           		<input name="last-name" placeholder="Senha" type="password">
                        	</div>
                    	</div>
                    	<button onclick="cadastrarUsuario()" class="ui green button" type="submit">Criar Conta</button>
                    </div>
                </div>
        		<div class="column">
            		<div class="ui equal width form">
                    	<h2 class="ui dividing header">Entrar</h2>
                    	<div class="field">
                    		<div class="field">
                           		<label>Digite seu E-Mail:</label>
                           		<input name="last-name" placeholder="E-Mail" type="email">
                        	</div>
                    	</div>
                    	<div class="field">
                    		<div class="field">
                           		<label>Digite sua senha:</label>
                           		<input name="last-name" placeholder="Senha" type="password">
                        	</div>
                    	</div>
                        <div class="field">
                        	<div class="ui checked checkbox">
                            	<input tabindex="0" checked="checked" name="manter_login" id="manter_login" class="hidden" type="checkbox">
                            	<label for="manter_login">Mantenha-me Conectado</label>
                        	</div>
                        </div>
                    	<button onclick="logarUsuario();" class="ui red button" type="submit">Entrar</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div id="div_orcamento" class="ui form <?php View_Solicitar_Orcamento::Esconder_Orcamento(); ?>">
        	<div id="div_text_orc" class="field">
        	</div>
        	<div class="field">
        		<label>Descrição: (Opcional)</label>
           		<textarea id="descricao" name="descricao" rows="2"></textarea>
        	</div>
        	<button onclick="criarOrcamento()" class="ui big yellow button">Enviar Solicitação de Orçamentos</button>
		</div>
		<div id="div_msg" class="ui hidden message">
        	<i class="close icon"></i>
        	<div id="msg_header" class="header"></div>
        	<ul id="msg_list" class="list"></ul>
        </div>
	</div>
</div>
<script type="text/javascript" src="/application/js/layout/modal/solicitar_orcamento.js"></script>