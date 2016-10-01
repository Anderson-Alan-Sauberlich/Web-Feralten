<script type="text/javascript" src="/application/view/js/include_page/menu_usuario.js"></script>
<section class="sombra_painel">
    <div class="panel panel-default borderPainel sombra_painel">
        <div class="menu_usuario_header">
            <div class="container-fluid menuNavPanel">
                <div class="col-sm-4">
                    <h4><label class="pull-felt">Menu de Navegação</label></h4>
                </div>
                <div class="ui divider visible-xs"></div>
                <div class="col-sm-8">
                    <h4><label class="pull-right">Seja bem vindo(a) <?php self::Mostrar_Nome(); ?></label></h4>
                </div>
            </div>
        </div>
        <div class="panel-body sombra_painel">
        	<div class="row-fluid sombra_painel visible-xs">
				<div class="ui styled fluid accordion">
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="title panel-heading <?php self::Verificar_URL_Ativa('meu-perfil'); ?>">
								<h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Meu Perfil</h4>
							</div>
							<div class="content <?php self::Verificar_URL_Ativa('meu-perfil'); ?>">
								Perfil
							</div>
						</div>
						<div class="panel panel-default">
							<div class="title panel-heading <?php self::Verificar_URL_Ativa('meus-dados'); ?>">
								<h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Meus Dados</h4>
							</div>
							<div class="content <?php self::Verificar_URL_Ativa('meus-dados'); ?>">
				            	<ul class="nav nav-pills">
				                	<li class="<?php self::Verificar_URL_Ativa('meus-dados', 'concluir'); ?>"><a href="/usuario/meu-perfil/meus-dados/concluir/">Concluir Cadastro</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'atualizar'); ?>"><a href="/usuario/meu-perfil/meus-dados/atualizar/">Atualizar Dados</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'alterar-senha'); ?>"><a href="/usuario/meu-perfil/meus-dados/alterar-senha/">Alterar Senha</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'enderecos'); ?>"><a href="/usuario/meu-perfil/meus-dados/enderecos/">Meu(s) Endereço(s)</a></li>
				                </ul>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="title panel-heading <?php self::Verificar_URL_Ativa('auto-pecas'); ?>">
								<h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Auto-Peças</h4>
							</div>
							<div class="content <?php self::Verificar_URL_Ativa('auto-pecas'); ?>">
				            	<ul class="nav nav-pills">
				                	<li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'visualizar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/visualizar/">Visualizar Peças</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'cadastrar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/cadastrar/">Cadastrar Peças</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'atualizar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/atualizar/">Atualizar Peças</a></li>
				                </ul>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="title panel-heading <?php self::Verificar_URL_Ativa('pacotes'); ?>">
								<h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Pacotes</h4>
							</div>
							<div class="content <?php self::Verificar_URL_Ativa('pacotes'); ?>">
				            	<ul class="nav nav-pills">
				                	<li class="<?php self::Verificar_URL_Ativa('pacotes', 'informacoes'); ?>"><a href="/usuario/meu-perfil/pacotes/informacoes/">Informações Sobre os Pacotes</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('pacotes', 'meus-pacotes'); ?>"><a href="/usuario/meu-perfil/pacotes/meus-pacotes/">Meus Pacotes</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('pacotes', 'adicionar'); ?>"><a href="/usuario/meu-perfil/pacotes/adicionar/">Adicionar Pacote(s)</a></li>
				                </ul>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="title panel-heading <?php self::Verificar_URL_Ativa('financeiro'); ?>">
								<h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Financeiro</h4>
							</div>
							<div class="content <?php self::Verificar_URL_Ativa('financeiro'); ?>">
				            	<ul class="nav nav-pills">
				                	<li class="<?php self::Verificar_URL_Ativa('financeiro', 'boleto-atual'); ?>"><a href="/usuario/meu-perfil/financeiro/boleto-atual/">Visualizar Boleto Atual</a></li>
				                    <li class="<?php self::Verificar_URL_Ativa('financeiro', 'boletos-pagos'); ?>"><a href="/usuario/meu-perfil/financeiro/boletos-pagos/">Visualizar Boletos Pagos</a></li>
				                </ul>
							</div>
						</div>
					</div>
				</div>
        	</div>
        	<div class="row-fluid sombra_painel hidden-xs">
				<div class="ui top attached tabular five item menu" role="tablist">
					<a id="perfil" onmouseover="MudarTabPerfil();" class="item <?php self::Verificar_URL_Ativa('meu-perfil'); ?>" role="tab" data-tab="perfil"><i class="pointing down icon lbPanel"></i>Meu Perfil</a>
					<a id="dados" onmouseover="MudarTabDados();" class="item <?php self::Verificar_URL_Ativa('meus-dados'); ?>" role="tab" data-tab="dados"><i class="pointing down icon lbPanel"></i>Meus Dados</a>
					<a id="pecas" onmouseover="MudarTabPecas();" class="item <?php self::Verificar_URL_Ativa('auto-pecas'); ?>" role="tab" data-tab="pecas"><i class="pointing down icon lbPanel"></i>Auto Peças</a>
					<a id="pacotes" onmouseover="MudarTabPacotes();" class="item <?php self::Verificar_URL_Ativa('pacotes'); ?>" role="tab" data-tab="pacotes"><i class="pointing down icon lbPanel"></i>Pacotes</a>
					<a id="financeiro" onmouseover="MudarTabFinanceiro();" class="item <?php self::Verificar_URL_Ativa('financeiro'); ?>" role="tab" data-tab="financeiro"><i class="pointing down icon lbPanel"></i>Financeiro</a>
				</div>
				<div role="tabpanel" class="ui attached tab segment <?php self::Verificar_URL_Ativa('meu-perfil'); ?>" data-tab="perfil">
					Perfil
				</div>
				<div role="tabpanel" class="ui attached tab segment <?php self::Verificar_URL_Ativa('meus-dados'); ?>" data-tab="dados">
	            	<ul class="nav nav-pills">
	                	<li class="<?php self::Verificar_URL_Ativa('meus-dados', 'concluir'); ?>"><a href="/usuario/meu-perfil/meus-dados/concluir/">Concluir Cadastro</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'atualizar'); ?>"><a href="/usuario/meu-perfil/meus-dados/atualizar/">Atualizar Dados</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'alterar-senha'); ?>"><a href="/usuario/meu-perfil/meus-dados/alterar-senha/">Alterar Senha</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('meus-dados', 'enderecos'); ?>"><a href="/usuario/meu-perfil/meus-dados/enderecos/">Meu(s) Endereço(s)</a></li>
	                </ul>
				</div>
				<div role="tabpanel" class="ui attached tab segment <?php self::Verificar_URL_Ativa("auto-pecas"); ?>" data-tab="pecas">
	            	<ul class="nav nav-pills">
	                	<li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'visualizar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/visualizar/">Visualizar Peças</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'cadastrar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/cadastrar/">Cadastrar Peças</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('auto-pecas', 'atualizar'); ?>"><a href="/usuario/meu-perfil/auto-pecas/atualizar/">Atualizar Peças</a></li>
	                </ul>
				</div>
				<div role="tabpanel" class="ui attached tab segment <?php self::Verificar_URL_Ativa("pacotes"); ?>" data-tab="pacotes">
	            	<ul class="nav nav-pills">
	                	<li class="<?php self::Verificar_URL_Ativa('pacotes', 'informacoes'); ?>"><a href="/usuario/meu-perfil/pacotes/informacoes/">Informações Sobre os Pacotes</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('pacotes', 'meus-pacotes'); ?>"><a href="/usuario/meu-perfil/pacotes/meus-pacotes/">Meus Pacotes</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('pacotes', 'adicionar'); ?>"><a href="/usuario/meu-perfil/pacotes/adicionar/">Adicionar Pacote(s)</a></li>
	                </ul>
				</div>
				<div role="tabpanel" class="ui attached tab segment <?php self::Verificar_URL_Ativa('financeiro'); ?>" data-tab="financeiro">
	            	<ul class="nav nav-pills">
	                	<li class="<?php self::Verificar_URL_Ativa('financeiro', 'boleto-atual'); ?>"><a href="/usuario/meu-perfil/financeiro/boleto-atual/">Visualizar Boleto Atual</a></li>
	                    <li class="<?php self::Verificar_URL_Ativa('financeiro', 'boletos-pagos'); ?>"><a href="/usuario/meu-perfil/financeiro/boletos-pagos/">Visualizar Boletos Pagos</a></li>
	                </ul>
				</div>
            </div>
        </div>
    </div>
</section>
<?php self::Incluir_Status_Usuario(); ?>