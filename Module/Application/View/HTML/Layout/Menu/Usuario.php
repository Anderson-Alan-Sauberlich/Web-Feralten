<?php use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario; ?>
<script type="text/javascript" src="/application/js/layout/menu/usuario.js"></script>
<section class="sombra_painel">
    <div class="panel panel-default borderPainel sombra_painel">
        <div class="menu_usuario_header">
            <div class="container-fluid menuNavPanel">
                <div class="col-sm-4">
                    <h4><label class="pull-felt">Menu de Navegação</label></h4>
                </div>
                <div class="ui divider visible-xs"></div>
                <div class="col-sm-8">
                    <h4><label class="pull-right">Seja bem vindo(a) <?php View_Usuario::Mostrar_Nome(); ?></label></h4>
                </div>
            </div>
        </div>
        <div class="panel-body sombra_painel">
            <div class="row-fluid sombra_painel visible-xs">
                <nav class="ui styled fluid accordion">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="title panel-heading <?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?>">
                                <h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Meu Perfil</h4>
                            </div>
                            <div class="content <?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?>">
                                Perfil
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="title panel-heading <?php View_Usuario::Verificar_URL_Ativa('meus-dados'); ?>">
                                <h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Meus Dados</h4>
                            </div>
                            <div class="content <?php View_Usuario::Verificar_URL_Ativa('meus-dados'); ?>">
                                <ul class="nav nav-pills">
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'concluir'); ?>"><a href="/usuario/meu-perfil/meus-dados/concluir/">Concluir Cadastro</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'atualizar'); ?>"><a href="/usuario/meu-perfil/meus-dados/atualizar/">Atualizar Dados</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'alterar-senha'); ?>"><a href="/usuario/meu-perfil/meus-dados/alterar-senha/">Alterar Senha</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'enderecos'); ?>"><a href="/usuario/meu-perfil/meus-dados/enderecos/">Meu(s) Endereço(s)</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="title panel-heading <?php View_Usuario::Verificar_URL_Ativa('pecas'); ?>">
                                <h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Peças</h4>
                            </div>
                            <div class="content <?php View_Usuario::Verificar_URL_Ativa('pecas'); ?>">
                                <ul class="nav nav-pills">
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'visualizar'); ?>"><a href="/usuario/meu-perfil/pecas/visualizar/">Visualizar Peças</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'cadastrar'); ?>"><a href="/usuario/meu-perfil/pecas/cadastrar/">Cadastrar Peças</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'atualizar'); ?>"><a href="/usuario/meu-perfil/pecas/atualizar/">Atualizar Peças</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="title panel-heading <?php View_Usuario::Verificar_URL_Ativa('financeiro'); ?>">
                                <h4 class="panel-title"><i class="pointing down icon lbPanel"></i>Financeiro</h4>
                            </div>
                            <div class="content <?php View_Usuario::Verificar_URL_Ativa('financeiro'); ?>">
                                <ul class="nav nav-pills">
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'meu-lano'); ?>"><a href="/usuario/meu-perfil/financeiro/meu-plano/">Meu Plano</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'fatura'); ?>"><a href="/usuario/meu-perfil/financeiro/fatura/">Fatura</a></li>
                                    <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'historico'); ?>"><a href="/usuario/meu-perfil/financeiro/historico/">Historico</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row-fluid sombra_painel hidden-xs">
                <div class="ui top attached tabular four item menu" role="tablist">
                    <a id="perfil" class="item <?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?>" role="tab" data-tab="perfil"><i class="pointing down icon lbPanel"></i>Meu Perfil</a>
                    <a id="dados" class="item <?php View_Usuario::Verificar_URL_Ativa('meus-dados'); ?>" role="tab" data-tab="dados"><i class="pointing down icon lbPanel"></i>Meus Dados</a>
                    <a id="pecas" class="item <?php View_Usuario::Verificar_URL_Ativa('pecas'); ?>" role="tab" data-tab="pecas"><i class="pointing down icon lbPanel"></i>Peças</a>
                    <a id="financeiro" class="item <?php View_Usuario::Verificar_URL_Ativa('financeiro'); ?>" role="tab" data-tab="financeiro"><i class="pointing down icon lbPanel"></i>Financeiro</a>
                </div>
                <div role="tabpanel" class="ui attached tab segment <?php View_Usuario::Verificar_URL_Ativa('meu-perfil'); ?>" data-tab="perfil">
                    Perfil
                </div>
                <div role="tabpanel" class="ui attached tab segment <?php View_Usuario::Verificar_URL_Ativa('meus-dados'); ?>" data-tab="dados">
                    <ul class="nav nav-pills">
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'concluir'); ?>"><a href="/usuario/meu-perfil/meus-dados/concluir/">Concluir Cadastro</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'atualizar'); ?>"><a href="/usuario/meu-perfil/meus-dados/atualizar/">Atualizar Dados</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'alterar-senha'); ?>"><a href="/usuario/meu-perfil/meus-dados/alterar-senha/">Alterar Senha</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('meus-dados', 'enderecos'); ?>"><a href="/usuario/meu-perfil/meus-dados/enderecos/">Meu(s) Endereço(s)</a></li>
                    </ul>
                </div>
                <div role="tabpanel" class="ui attached tab segment <?php View_Usuario::Verificar_URL_Ativa("pecas"); ?>" data-tab="pecas">
                    <ul class="nav nav-pills">
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'visualizar'); ?>"><a href="/usuario/meu-perfil/pecas/visualizar/">Visualizar Peças</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'cadastrar'); ?>"><a href="/usuario/meu-perfil/pecas/cadastrar/">Cadastrar Peças</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('pecas', 'atualizar'); ?>"><a href="/usuario/meu-perfil/pecas/atualizar/">Atualizar Peças</a></li>
                    </ul>
                </div>
                <div role="tabpanel" class="ui attached tab segment <?php View_Usuario::Verificar_URL_Ativa('financeiro'); ?>" data-tab="financeiro">
                    <ul class="nav nav-pills">
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'meu-plano'); ?>"><a href="/usuario/meu-perfil/financeiro/meu-plano/">Meu Plano</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'fatura'); ?>"><a href="/usuario/meu-perfil/financeiro/fatura/">Fatura</a></li>
                        <li class="<?php View_Usuario::Verificar_URL_Ativa('financeiro', 'historico'); ?>"><a href="/usuario/meu-perfil/financeiro/historico/">Historico</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php View_Usuario::Incluir_Mensagem_Status_Usuario(); ?>