<?php use Module\Application\View\SRC\Layout\Modal\Solicitar_Orcamento as View_Solicitar_Orcamento; ?>
<div class="ui container">
	<div class="ui horizontal divider">OU</div>
	<h4 class="ui header">Não achou o que procurava? Solicite aos nossos vendedores!</h4>
	<div onclick="abrirModal()" class="ui massive black button">Solicitar Orçamentos</div>
</div>
<div id="mdl_enviar" class="ui mini modal">
	<i class="close icon"></i>
	<div class="header">Preencha os campos obrigatórios:</div>
    <ul id="mdl_content" class="inverted list"></ul>
    <div class="actions">
        <div class="ui approve right labeled icon button">Continuar <i class="checkmark icon"></i></div>
    </div>
</div>
<div id="mdl_orcamento" class="ui modal">
	<i class="close icon"></i>
	<div class="scrolling content">
		<?php if (!View_Solicitar_Orcamento::Verificar_Logado()) { ?>
			<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=pt" async defer></script>
        	<div id="div_autenticacao" class="ui two column relaxed stackable internally celled grid">
        		<div class="column">
            		<div id="form_login" class="ui equal width form">
                    	<h2 class="ui dividing header">Entrar com sua conta</h2>
                    	<div class="field">
                           	<label for="login_email">Seu E-Mail:</label>
                           	<div class="ui left icon input">
                           		<i class="mail icon"></i>
                           		<input id="login_email" placeholder="E-Mail" type="email">
                           	</div>
                    	</div>
                    	<div class="field">
                           	<label for="login_senha">Sua senha:</label>
                           	<div class="ui left icon input">
                           		<i class="unlock alternate icon"></i>
                           		<input id="login_senha" placeholder="Senha" type="password">
                           	</div>
                    	</div>
                        <div class="field">
                        	<div class="ui checked checkbox">
                            	<input tabindex="0" checked="checked" id="login_manter" class="hidden" type="checkbox">
                            	<label for="login_manter">Mantenha-me Conectado</label>
                        	</div>
                        </div>
                        <div id="login_msg" class="ui hidden message">
                        	<i class="close icon"></i>
                        	<div id="login_msg_header" class="header"></div>
                        	<ul id="login_msg_list" class="list"></ul>
                        </div>
                    	<button onclick="logarUsuario();" class="ui red big fluid button" type="submit"><i class="sign in icon"></i>Entrar</button>
                    </div>
                </div>
        		<div class="column">
                    <div id="form_cadastro" class="ui equal width form">
                    	<h2 class="ui dividing header">Criar uma conta</h2>
                        <div class="two fields">
                        	<div class="field">
                           		<label for="cadastro_nome">Seu Nome:</label>
                           		<div class="ui left icon input">
                           			<i class="user icon"></i>
                           			<input id="cadastro_nome" placeholder="Nome" type="text">
                           		</div>
                           	</div>
                           	<div class="field">
                           		<label for="cadastro_sobrenome">Seu Sobrenome:</label>
                           		<div class="ui left icon input">
                           			<i class="user icon"></i>
                           			<input id="cadastro_sobrenome" placeholder="Sobrenome" type="text">
                           		</div>
                        	</div>
                        </div>
                    	<div class="field">
                           	<label for="cadastro_email">Seu E-Mail:</label>
                           	<div class="ui left icon input">
                           		<i class="mail icon"></i>
                           		<input id="cadastro_email" placeholder="E-Mail" type="email">
                           	</div>
                    	</div>
                    	<div class="field">
                           	<label for="cadastro_senha">Crie uma senha:</label>
                           	<div class="ui left icon input">
                           		<i class="unlock alternate icon"></i>
                           		<input id="cadastro_senha" placeholder="Senha" type="password">
                           	</div>
                    	</div>
                    	<div class="field">
                    		<div id="recaptcha" class="g-recaptcha" data-sitekey="6LeGszcUAAAAAJe8rA1Id_3ecGcA5GvceGO572jQ"></div>
                    	</div>
                    	<div id="cadastro_msg" class="ui hidden message">
                        	<i class="close icon"></i>
                        	<div id="cadastro_msg_header" class="header"></div>
                        	<ul id="cadastro_msg_list" class="list"></ul>
                        </div>
                    	<button onclick="cadastrarUsuario()" class="ui green big fluid button" type="submit"><i class="user plus icon"></i>Criar Conta</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div id="div_orcamento" class="ui form <?php View_Solicitar_Orcamento::Esconder_Orcamento(); ?>">
        	<div id="div_text_orc" class="field">
        	</div>
        	<div class="field">
        		<label>Descrição: (Opcional)</label>
           		<textarea id="descricao" rows="2"></textarea>
        	</div>
        	<button onclick="criarOrcamento()" class="ui big black button">Enviar Solicitação de Orçamentos</button>
		</div>
		<div id="div_msg" class="ui hidden message">
        	<i class="close icon"></i>
        	<div id="msg_header" class="header"></div>
        	<ul id="msg_list" class="list"></ul>
        </div>
	</div>
</div>
<script type="text/javascript" src="/application/js/layout/modal/solicitar_orcamento.js"></script>