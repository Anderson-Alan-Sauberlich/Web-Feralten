<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as View_Usuario; ?>
<div id="div_usuario" class="ui stackable centered grid">
	<div class="eleven wide column">
        <div id="form_usuario" class="ui equal width form">
        	<div id="usuario_msg" class="ui hidden message">
            	<i class="close icon"></i>
            	<div id="usuario_msg_header" class="header"></div>
            	<ul id="usuario_msg_list" class="list"></ul>
            </div>
            <div class="fields">
            	<div id="div_usuario_nome" class="required field">
               		<label class="ui red header" for="usuario_nome">Nome:</label>
               		<div class="ui left icon input">
						<i class="user outline icon"></i>
               			<input id="usuario_nome" name="usuario_nome" placeholder="Nome" value="<?= View_Usuario::MostrarNome(); ?>" type="text" data-content="Digite Apenas seu Nome. (Obrigatório)">
               		</div>
               	</div>
               	<div id="div_usuario_sobrenome" class="required field">
               		<label class="ui red header" for="usuario_sobrenome">Sobrenome:</label>
               		<div class="ui left icon input">
						<i class="user outline icon"></i>
               			<input id="usuario_sobrenome" name="usuario_sobrenome" placeholder="Sobrenome" value="<?= View_Usuario::MostrarSobrenome(); ?>" type="text" data-content="Digite seu Sobrenome. (Obrigatório)">
            		</div>
            	</div>
            </div>
            <div class="fields">
            	<div id="div_usuario_email" class="required field">
                   	<label class="ui red header" for="usuario_email">Seu E-Mail:</label>
                   	<div class="ui left icon input">
						<i class="mail outline icon"></i>
               			<input id="usuario_email" name="usuario_email" placeholder="E-Mail" value="<?= View_Usuario::MostrarEmail(); ?>" type="email" data-content="Este e-mail será usado para gerenciar seu Cadastro e para acessar o Sistema. (Obrigatório)">
            		</div>
            	</div>
            	<div id="div_usuario_email_alternativo" class="field">
                   	<label class="ui red header" for="usuario_email_alternativo">E-Mail alternativo:</label>
                   	<div class="ui left icon input">
						<i class="mail outline icon"></i>
               			<input id="usuario_email_alternativo" name="usuario_email_alternativo" placeholder="E-Mail Alternativo" value="<?= View_Usuario::MostrarEmailAlternativo(); ?>" type="email" data-content="Este e-mail recebe cópias de todos os e-mails enviados ao se e-mail principal. (Opcional)">
            		</div>
            	</div>
        	</div>
        	<div class="fields">
            	<div id="div_usuario_fone" class="required field">
               		<label class="ui red header" for="usuario_fone">Numero de telefone:</label>
               		<div class="ui left icon input">
						<i class="text telephone icon"></i>
               			<input id="usuario_fone" name="usuario_fone" placeholder="Fone Ex.: (00) 0000-0000" value="<?= View_Usuario::MostrarFone(); ?>" type="text" data-content="Digite apenas os Numeros de seu telefone. (Obrigatório)">
               		</div>
               	</div>
               	<div id="div_usuario_fone_alternativo" class="field">
               		<label class="ui red header" for="usuario_fone_alternativo">Numero de telefone alternativo:</label>
               		<div class="ui left icon input">
						<i class="text telephone icon"></i>
               			<input id="usuario_fone_alternativo" name="usuario_fone_alternativo" placeholder="Fone Ex.: (00) 0000-0000" value="<?= View_Usuario::MostrarFoneAlternativo(); ?>" type="text" data-content="Digite apenas os Numeros de seu telefone alternativo. (Opcional)">
            		</div>
            	</div>
            </div>
            <?php if (View_Usuario::VerificaLoginEntidade()) { ?>
                <div class="ui divider"></div>
                <div class="field">
                	<div class="ui fluid buttons">
                        <button id="salvar_usuario" name="salvar_usuario" onclick="SalvarUsuario()" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
                        <div class="or" data-text="Ou"></div>
                        <button id="restaurar_usuario" name="restaurar_usuario" onclick="RestaurarUsuario()" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="/application/js/usuario/meu_perfil/meus_dados/editar_dados/usuario.js"></script>