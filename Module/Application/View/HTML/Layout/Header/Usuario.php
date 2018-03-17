<?php use Module\Application\View\SRC\Layout\Header\Usuario as View_Usuario; ?>
<nav id="m_menu_usuario" class="ui two item borderless grey inverted top fixed large menu" role="navigation">
    <a href="/usuario/meu-perfil/" class="<?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?> item">
    	<img class="ui mini rounded image menu_logo" onError="MostImgErr($this)" src="<?= View_Usuario::RetornarImagemEntidade(); ?>"/>
        <b>Meu Perfil</b>
    </a>
    <div onclick="AbrirMobileMenuUsuarioSidebar()" class="link fluid item">
       	<i class="bars icon"></i>Menu
    </div>
</nav>
<nav id="m_menu_usuario_sidebar" class="ui grey inverted top sidebar vertical large menu" role="navigation">
    <div class="ui inverted accordion <?php View_Usuario::Verificar_URL_Ativa('orcamentos'); ?> item">
    	<div class="title"><i class="chevron down icon"></i>Orçamentos</div>
        <div class="content field">
            <div class="ui inverted link large relaxed list">
               	<a href="/usuario/meu-perfil/orcamentos/meus-orcamentos/" class="<?php View_Usuario::Verificar_URL_Ativa('orcamentos', 'meus-orcamentos'); ?> item">Meus Orçamentos</a>
   				<a href="/usuario/meu-perfil/orcamentos/caixa-de-entrada/" class="<?php View_Usuario::Verificar_URL_Ativa('orcamentos', 'orcamentos-recebidos'); ?> item">Orçamentos Recebidos</a>
            </div>
        </div>
    </div>
    <div class="ui inverted accordion <?php View_Usuario::Verificar_URL_Ativa('pecas'); ?> item">
    	<div class="title"><i class="chevron down icon"></i>Peças</div>
        <div class="content field">
            <div class="ui inverted link large relaxed list">
               	<a href="/usuario/meu-perfil/pecas/visualizar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'visualizar'); ?> item">Visualizar Peças</a>
   				<a href="/usuario/meu-perfil/pecas/cadastrar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'cadastrar'); ?> item">Cadastrar Peças</a>
   				<a href="/usuario/meu-perfil/pecas/atualizar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'atualizar'); ?> item">Atualizar Peças</a>
            </div>
        </div>
    </div>
    <div class="ui inverted accordion item">
    	<div class="title"><i class="chevron down icon"></i>Sair</div>
        <div class="content field">
            <div class="ui inverted link large relaxed list">
               	<a href="/" class="item"><i class="home icon"></i>Início</a>
       			<a href="/fale-conosco/" class="item"><i class="envelope icon"></i>Contato</a>
       			<a href="/usuario/login/sair/?logout=<?php View_Usuario::MostrarCodigoLogout(); ?>" class="item"><i class="sign out icon"></i>Logout</a>
            </div>
        </div>
    </div>
</nav>
<nav id="pc_menu_usuario" class="ui four item borderless grey inverted top fixed stackable large menu main" role="navigation">
    <div class="ui container">
        <a href="/usuario/meu-perfil/" class="<?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?> item">
        	<img class="ui mini rounded image menu_logo" onError="MostImgErr($this)" src="<?= View_Usuario::RetornarImagemEntidade(); ?>"/>
        	<b>Meu Perfil</b>
        </a>
        <div class="ui dropdown <?php //View_Usuario::Verificar_URL_Ativa('orcamentos'); ?> item">
        	<b>Orçamentos</b>
        	<i class="dropdown icon"></i>
        	<div class="menu">
    			<a href="/usuario/meu-perfil/orcamentos/meus-orcamentos/" class="<?php View_Usuario::Verificar_URL_Ativa('orcamentos', 'meus-orcamentos'); ?> item">Meus Orçamentos</a>
    			<a href="/usuario/meu-perfil/orcamentos/caixa-de-entrada/" class="<?php View_Usuario::Verificar_URL_Ativa('orcamentos', 'orcamentos-recebidos'); ?> item">Orçamentos Recebidos</a>
    		</div>
        </div>
        <div class="ui dropdown <?php //View_Usuario::Verificar_URL_Ativa('pecas'); ?> item">
        	<b>Peças</b>
        	<i class="dropdown icon"></i>
        	<div class="menu">
    			<a href="/usuario/meu-perfil/pecas/visualizar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'visualizar'); ?> item">Visualizar Peças</a>
    			<a href="/usuario/meu-perfil/pecas/cadastrar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'cadastrar'); ?> item">Cadastrar Peças</a>
    			<a href="/usuario/meu-perfil/pecas/atualizar/" class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'atualizar'); ?> item">Atualizar Peças</a>
    		</div>
        </div>
        <div class="ui dropdown item">
        	<b>Sair</b>
        	<i class="dropdown icon"></i>
    		<div class="menu">
    			<a href="/" class="item"><i class="home icon"></i>Início</a>
    			<a href="/fale-conosco/" class="item"><i class="envelope icon"></i>Contato</a>
    			<a href="/usuario/login/sair/?logout=<?php View_Usuario::MostrarCodigoLogout(); ?>" class="item"><i class="sign out icon"></i>Logout</a>
    		</div>
        </div>
    </div>
</nav>
<div class="margem-inferior-menu-usuario"></div>
<script type="text/javascript" src="/application/js/layout/header/usuario.js"></script>
<?php View_Usuario::Incluir_Mensagem_Status_Usuario(); ?>