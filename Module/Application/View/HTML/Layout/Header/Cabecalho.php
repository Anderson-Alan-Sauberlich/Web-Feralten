<?php use Module\Application\View\SRC\Layout\Header\Cabecalho as View_Cabecalho; ?>
<section class="margem-inferior-pouco">
	<nav id="m_header" class="ui borderless red inverted top fixed two item hidden menu main" role="navigation">
        <a href="/" class="header item">
            <img class="ui mini image header_logo" src="/resources/img/favicon.png"/>
        	FERALTEN
        </a>
        <div onclick="AbrirMobileHeaderSidebar()" class="link fluid item">
           	<i class="bars icon"></i>Menu
        </div>
	</nav>
	<nav id="m_header_menu" class="ui red inverted top sidebar vertical menu" role="navigation">
    	<div class="ui container">
    		<div class="item">
            	<a href="/"><i class="home icon"></i>INÍCIO</a>
            </div>
            <div class="ui inverted accordion item">
            	<div class="title"><i class="cart arrow down icon"></i>COMPRAR</div>
                <div class="content field">
                    <div class="ui inverted link large relaxed list">
                       	<a href="/vendedores/" class="item">Vendedores</a>
                       	<a href="/orcamentos/" class="item">Orçamentos</a>
                    	<a href="/pecas/resultados/" class="item">Peças Cadastradas</a>
                    	<a href="/planos-mensais/" class="item">Planos Mensais</a>
                    </div>
                </div>
            </div>
    		<div class="item">
            	<a href="/fale-conosco/"><i class="envelope icon"></i>CONTATO</a>
            </div>
			<?php if (View_Cabecalho::VerificaAutenticacao()) { ?>
				<div class="item">
					<a href="/usuario/meu-perfil/"><i class="user icon"></i>Olá! <b><?= View_Cabecalho::RetornarNomeMeuFeralten(); ?></b></a>
				</div>
				<div class="item">
					<a href="/usuario/login/sair/?logout=<?= View_Cabecalho::RetornarCodigoLogout(); ?>"><i class="sign out icon"></i><b>SAIR</b></a>
				</div>
			<?php } else { ?>
				<div class="item">
					<a href="/usuario/cadastro/"><i class="user icon"></i><b>CADASTRAR</b></a>
				</div>
				<div class="item">
					<a href="/usuario/login/"><i class="sign in icon"></i><b>ENTRAR</b></a>
				</div>
			<?php } ?>
		</div>
	</nav>
    <nav id="pc_header" class="ui borderless red inverted stackable top fixed menu main" role="navigation">
    	<div class="ui container">
        	<a href="/quem-somos/" class="header item">
        		<img class="ui mini image header_logo" src="/resources/img/favicon.png"/>
        		FERALTEN
            </a>
           	<div class="left menu">
               	<a href="/" class="item"><i class="home icon"></i>INÍCIO</a>
               	<a id="comprar_item" class="item"><i class="cart arrow down icon"></i>COMPRAR</a>
                <div id="popup_comprar" class="ui popup">
            		<div class="ui basic segment">
                		<div class="ui link divided large very relaxed list">
                        	<a href="/vendedores/" class="item">Vendedores</a>
                        	<a href="/orcamentos/" class="item">Orçamentos</a>
                    		<a href="/pecas/resultados/" class="item">Peças Cadastradas</a>
                    		<a href="/planos-mensais/" class="item">Planos Mensais</a>
                        </div>
                    </div>
                </div>
               	<a href="/fale-conosco/" class="item"><i class="envelope icon"></i>CONTATO</a>
            </div>
           	<div class="right menu">
           		<?php if (View_Cabecalho::VerificaAutenticacao()) { ?>
                    <div id="drop_meu_feralten" class="ui pointing dropdown item">
                    	<label for="drop_meu_feralten" class="ui basic red label">Olá!</label>
                    	<b>MEU FERALTEN</b>
                    	<i class="dropdown icon"></i>
                    	<div class="menu">
                    		<h3 class="ui header"><div class="sub header">Bem vindo,</div></h3>
                    		<a href="/usuario/meu-perfil/" class="item"><i class="user icon"></i><?= View_Cabecalho::RetornarNomeMeuFeralten(); ?></a>
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