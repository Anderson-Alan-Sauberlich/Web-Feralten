<?php use Module\Application\View\SRC\Layout\Header\Cabecalho as View_Cabecalho; ?>
<section class="margem-inferior-pouco">
    <nav class="ui red inverted stackable top fixed menu" role="navigation">
    	<div class="ui container">
        	<div class="header item">
        		<img class="logo" src="/resources/img/favicon.png">
        		Feralten
            	<div onclick="ControlaItems()" id="btn_controle_header" class="ui icon inverted basic hidden button btn_abre_header">
                	<i class="bars icon"></i>
                </div>
            </div>
           	<div id="header_esquerda" class="left menu">
               	<a href="/" class="item"><i class="home icon"></i>INÍCIO</a>
               	<a id="comprar_item" class="item"><i class="cart arrow down icon"></i>COMPRAR</a>
                <div class="ui comprar popup bottom left transition hidden">
            		<div class="ui basic segment">
                		<div class="ui link divided large very relaxed list">
                        	<a href="#" class="item">Vendedores</a>
            	    		<a href="/pesquisa-avancada/" class="item">Pesquisa Avançada</a>
                    		<a href="/pecas/busca-programada/" class="item">Busca Programada</a>
                    		<a href="/pecas/mais-visualizados/" class="item">Mais Visualizados</a>
                        </div>
                    </div>
                </div>
               	<a id="vender_item" class="item"><i class="bullhorn icon"></i>VENDER</a>
               	<div class="ui vender popup bottom left transition hidden">
            		<div class="ui basic segment">
                		<div class="ui link divided large very relaxed list">
                        	<a href="/dicas-de-venda/venda-segura/" class="item">Venda Segura</a>
                            <a href="/pecas/resultados/" class="item">Auto Peças</a>
                            <a href="/publicidade/experimentar-formatos/" class="item">Publicidade</a>
                        </div>
                    </div>
                </div>
            </div>
           	<div id="header_direita" class="right menu">
           		<?php if (View_Cabecalho::VerificaAutenticacao()) { ?>
                    <div id="drop_meu_feralten" class="ui pointing dropdown item">
                    	<label for="drop_meu_feralten" class="ui basic red label">Olá!</label>
                    	<b>MEU FERALTEN</b>
                    	<i class="dropdown icon"></i>
                    	<div class="menu">
                    		<div class="header">Bem vindo,</div>
                    		<a href="/usuario/meu-perfil/" class="item"><b><?= View_Cabecalho::RetornarNomeMeuFeralten(); ?></b></a>
                    		<div class="divider"></div>
                        	<a href="/usuario/meu-perfil/orcamentos/meus-orcamentos/" class="item">Meus Orçamentos</a>
                        	<a href="/usuario/meu-perfil/pecas/cadastrar/" class="item">Cadastrar Peças</a>
                        	<div class="divider"></div>
                        	<a href="/usuario/meu-perfil/meus-dados/editar-dados/" class="item">Editar Dados</a>
                        	<a href="/usuario/meu-perfil/meus-dados/alterar-senha/" class="item">Alterar Senha</a>
                        	<div class="divider"></div>
                        	<a href="/usuario/login/sair/?logout=<?= View_Cabecalho::RetornarCodigoLogout(); ?>" class="item"><i class="sign out icon"></i>Sair</a>
                    	</div>
                    </div>
        		<?php } else { ?>
        			<a href="/usuario/cadastro/" class="item"><i class="user icon"></i><b>CADASTRAR</b></a>
            		<a href="/usuario/login/" class="item"><i class="sign in icon"></i><b>ENTRAR</b></a>
        		<?php } ?>
        	</div>
    	</div>
    </nav>
</section>
<script type="text/javascript" src="/application/js/layout/header/cabecalho.js"></script>