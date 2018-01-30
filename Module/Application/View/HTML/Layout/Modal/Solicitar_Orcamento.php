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
			<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=pt" async defer></script>
        	<div id="div_autenticacao" class="ui two column relaxed stackable internally celled grid">
        		<div class="column">
                    <div id="form_cadastro" class="ui equal width form">
                    	<h2 class="ui dividing header">Criar Cadastro</h2>
                        <div class="fields">
                        	<div class="field">
                           		<label for="cadastro_nome">Digite seu nome:</label>
                           		<input id="cadastro_nome" name="cadastro_nome" placeholder="Nome" type="text">
                           	</div>
                           	<div class="field">
                           		<label for="cadastro_sobrenome">Digite seu sobrenome:</label>
                           		<input id="cadastro_sobrenome" name="cadastro_sobrenome" placeholder="Sobrenome" type="text">
                        	</div>
                        </div>
                    	<div class="field">
                           	<label for="cadastro_email">Digite seu E-Mail:</label>
                           	<input id="cadastro_email" name="cadastro_email" placeholder="E-Mail" type="email">
                    	</div>
                    	<div class="field">
                           	<label for="cadastro_senha">Cire uma senha:</label>
                           	<input id="cadastro_senha" name="cadastro_senha" placeholder="Senha" type="password">
                    	</div>
                    	<div class="field">
                    		<div id="recaptcha" class="g-recaptcha" data-sitekey="6LeGszcUAAAAAJe8rA1Id_3ecGcA5GvceGO572jQ"></div>
                    	</div>
                    	<div id="cadastro_msg" class="ui hidden message">
                        	<i class="close icon"></i>
                        	<div id="cadastro_msg_header" class="header"></div>
                        	<ul id="cadastro_msg_list" class="list"></ul>
                        </div>
                    	<button onclick="cadastrarUsuario()" class="ui green button" type="submit">Criar Conta</button>
                    </div>
                </div>
        		<div class="column">
            		<div id="form_login" class="ui equal width form">
                    	<h2 class="ui dividing header">Entrar</h2>
                    	<div class="field">
                           	<label for="login_email">Digite seu E-Mail:</label>
                           	<input id="login_email" name="login_email" placeholder="E-Mail" type="email">
                    	</div>
                    	<div class="field">
                           	<label for="login_senha">Digite sua senha:</label>
                           	<input id="login_senha" name="login_senha" placeholder="Senha" type="password">
                    	</div>
                        <div class="field">
                        	<div class="ui checked checkbox">
                            	<input tabindex="0" checked="checked" name="login_manter" id="login_manter" class="hidden" type="checkbox">
                            	<label for="login_manter">Mantenha-me Conectado</label>
                        	</div>
                        </div>
                        <div id="login_msg" class="ui hidden message">
                        	<i class="close icon"></i>
                        	<div id="login_msg_header" class="header"></div>
                        	<ul id="login_msg_list" class="list"></ul>
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