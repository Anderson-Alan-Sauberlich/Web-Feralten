<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as View_Endereco; ?>
<div id="div_endereco" class="ui stackable centered grid">
	<div class="eleven wide column">
        <div id="form_endereco" class="ui equal width form">
        	<div id="endereco_msg" class="ui hidden message">
            	<i class="close icon"></i>
            	<div id="endereco_msg_header" class="header"></div>
            	<ul id="endereco_msg_list" class="list"></ul>
            </div>
            <div id="div_endereco_cep" class="eight wide required field">
            	<label class="ui red header" for="endereco_cep">CEP:</label>
            	<div class="ui left icon input">
					<i class="marker icon"></i>
               		<input id="endereco_cep" name="endereco_cep" placeholder="CEP" value="<?= View_Endereco::MostrarCEP(); ?>" type="text" data-content="Digite apenas os números do seu CEP. (Obrigatório)">
            	</div>
            </div>
            <div class="ui divider"></div>
            <div class="fields">
            	<div id="div_endereco_estado" class="required field">
               		<label class="ui red header" for="endereco_estado">Estado:</label>
                    <div id="endereco_estado" class="ui fluid scrolling search selection icon dropdown">
                    	<i class="map outline icon"></i>
                    	<input name="endereco_estado" type="hidden">
                    	<i class="dropdown icon"></i>
                    	<div class="default text">Estado</div>
                    	<div id="endereco_estado_menu" class="menu">
                    		<?php View_Endereco::MostrarEstados(); ?>
                    	</div>
                    </div>
                    <?php if (View_Endereco::VerificaLoginEntidade()) { ?>
                        <script type="text/javascript">
                            $('#endereco_estado').dropdown('set text', '<?= View_Endereco::MostrarNomeEstado(); ?>');
                            $('#endereco_estado').dropdown('set value', '<?= View_Endereco::MostrarIDEstado(); ?>');
                        </script>
                    <?php } ?>
               	</div>
               	<div id="div_endereco_cidade" class="required field">
               		<label class="ui red header" for="endereco_cidade">Cidade:</label>
                    <div id="endereco_cidade" class="ui fluid scrolling search selection icon dropdown">
                    	<i class="map outline icon"></i>
                    	<input name="endereco_cidade" type="hidden">
                    	<i class="dropdown icon"></i>
                    	<div class="default text">Cidade</div>
                    	<div id="endereco_cidade_menu" class="menu">
                    		<?php View_Endereco::MostrarCidades(); ?>
                    	</div>
                    </div>
                    <?php if (View_Endereco::VerificaLoginEntidade()) { ?>
                        <script type="text/javascript">
                            $('#endereco_cidade').dropdown('set text', '<?= View_Endereco::MostrarNomeCidade(); ?>');
                            $('#endereco_cidade').dropdown('set value', '<?= View_Endereco::MostrarIDCIdade(); ?>');
                        </script>
                    <?php } ?>
            	</div>
            </div>
            <div class="fields">
            	<div id="div_endereco_bairro" class="required field">
               		<label class="ui red header" for="endereco_bairro">Bairro:</label>
               		<div class="ui left icon input">
						<i class="map signs icon"></i>
               			<input id="endereco_bairro" name="endereco_bairro" placeholder="Bairro" value="<?= View_Endereco::MostrarBairro(); ?>" type="text" data-content="Digite o Nome Completo do Bairro. (Obrigatório)">
               		</div>
               	</div>
               	<div id="div_endereco_rua" class="required field">
               		<label class="ui red header" for="endereco_rua">Rua:</label>
               		<div class="ui left icon input">
						<i class="map signs icon"></i>
               			<input id="endereco_rua" name="endereco_rua" placeholder="Rua" value="<?= View_Endereco::MostrarRua(); ?>" type="text" data-content="Digite o nome Completo da Rua. (Obrigatório)">
            		</div>
            	</div>
            </div>
            <div class="fields">
            	<div id="div_endereco_numero" class="required field">
                   	<label class="ui red header" for="endereco_numero">Número do Estabelecimento:</label>
                   	<div class="ui left icon input">
						<i class="home icon"></i>
               			<input id="endereco_numero" name="endereco_numero" placeholder="Numero" value="<?= View_Endereco::MostrarNumero(); ?>" type="text" data-content="Digite o Número do Endereço. (Obrigatório)">
            		</div>
            	</div>
            	<div id="div_endereco_complemento" class="field">
                   	<label class="ui red header" for="endereco_complemento">Complemento:</label>
                   	<div class="ui left icon input">
						<i class="talk outline icon"></i>
               			<input id="endereco_complemento" name="endereco_complemento" placeholder="Complemento" value="<?= View_Endereco::MostrarComplemento(); ?>" type="text" data-content="Digite um Complemento de Referencia para o Endereço. (Opcional)">
            		</div>
            	</div>
        	</div>
        	<?php if (View_Endereco::VerificaLoginEntidade()) { ?>
                <div class="ui divider"></div>
                <div class="field">
                	<div class="ui fluid buttons">
                        <button id="salvar_usuario" name="salvar_usuario" onclick="SalvarEndereco()" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
                        <div class="or" data-text="Ou"></div>
                        <button id="restaurar_usuario" name="restaurar_usuario" onclick="RestaurarEndereco()" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="/application/js/usuario/meu_perfil/meus_dados/editar_dados/endereco.js"></script>