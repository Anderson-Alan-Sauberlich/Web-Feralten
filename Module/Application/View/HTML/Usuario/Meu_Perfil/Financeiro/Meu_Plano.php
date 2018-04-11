<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Meu_Plano as View_Meu_Plano; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meu Plano | Feralten</title>
</head>
<body>
    <header>
        <?php View_Meu_Plano::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <div class="ui stackable grid">
        	<div class="three wide column">
        		<?php View_Meu_Plano::Incluir_Menu_Usuario(); ?>
        	</div>
        	<div class="thirteen wide column">
                <div class="ui secondary segment">
                    <div class="ui doubling raised inverted grey stackable link three cards">
                        <div onclick="btn_plano(1);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Até <?php View_Meu_Plano::Mostrar_Limite_Pecas(1); ?></h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        GRÁTIS
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_1" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(1); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(1); ?></button>
                            </div>
                        </div>
                        <div onclick="btn_plano(2);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Até <?php View_Meu_Plano::Mostrar_Limite_Pecas(2); ?></h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        <?php View_Meu_Plano::Mostrar_Valor(2); ?>
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_2" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(2); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(2); ?></button>
                            </div>
                        </div>
                        <div onclick="btn_plano(3);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Até <?php View_Meu_Plano::Mostrar_Limite_Pecas(3); ?></h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        <?php View_Meu_Plano::Mostrar_Valor(3); ?>
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_3" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(3); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(3); ?></button>
                            </div>
                        </div>
                        <div onclick="btn_plano(4);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Até <?php View_Meu_Plano::Mostrar_Limite_Pecas(4); ?></h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        <?php View_Meu_Plano::Mostrar_Valor(4); ?>
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_4" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(4); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(4); ?></button>
                            </div>
                        </div>
                        <div onclick="btn_plano(5);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Até <?php View_Meu_Plano::Mostrar_Limite_Pecas(5); ?></h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        <?php View_Meu_Plano::Mostrar_Valor(5); ?>
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_5" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(5); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(5); ?></button>
                            </div>
                        </div>
                        <div onclick="btn_plano(6);" class="card">
                            <div class="content">
                                <div class="center aligned header">
                                    <h1>Sem limites</h1>
                                </div>
                                <div class="center aligned meta">
                                    <h3>Peças<br>Simultaneamente</h3>
                                </div>
                            </div>
                            <div class="content">
                                <div class="description">
                                    <b>Com orçamentos gratuitos</b>
                                </div>
                            </div>
                            <div class="center aligned content">
                                <div class="ui orange statistic">
                                    <div class="label">
                                        <h3>R$:</h3>
                                    </div>
                                    <div class="value">
                                        <?php View_Meu_Plano::Mostrar_Valor(6); ?>
                                    </div>
                                    <div class="label meta">
                                        <span>/mês</span>
                                    </div>
                                </div>
                            </div>
                            <div class="extra content">
                                   <button id="btn_plano_6" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(6); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(6); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="margem-inferior-minimo"></div>
                <button id="btn_cancelar_contratacao" onclick="btn_cancelar_contratacao()" class="ui red large <?= View_Meu_Plano::retornarStatusCancelarContratacao(); ?> button">Cancelar Contratação do Plano?</button>
                <label for="btn_cancelar_contratacao" class="ui red basic <?= View_Meu_Plano::retornarStatusCancelarContratacao(); ?> label">Cuidado, Irreversível!</label>
                <div class="margem-inferior-pouco"></div>
                <div id="mdl_msg" class="ui small modal">
                    <i class="close icon"></i>
                    <div id="msg_header" class="header">Deseja continuar?</div>
                    <div id="msg_content" class="content"></div>
                    <div class="actions">
                        <div id="btn_cancelar" class="ui cancel secondary button">Cancelar</div>
                        <div id="btn_aceitar" class="ui approve primary right labeled icon button">Aceitar <i class="checkmark icon"></i></div>
                    </div>
                </div>
                <div id="mdl_confirmacao" class="ui tiny modal">
                    <i class="close icon"></i>
                    <div class="header">Confirmação de Segurança</div>
                    <div class="content">
                        <div id="msg_mdl_confirmacao" class="ui error hidden message">
                        	<i class="close icon"></i>
                        	<div id="header_msg_mdl_confirmacao" class="header"></div>
                        </div>
                        <label for="senha_usuario" class="lbPanel">Digite sua Senha:</label>
                        <div class="input-group menuRowMD">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="senha_usuario" type="password" class="form-control" name="senha_usuario" autocomplete="off" placeholder="Senha" />
                            <span class="input-group-addon">
                                <div id="ui_mostrar" class="ui checkbox passCheck">
                                    <input type="checkbox" id="mostrar" name="mostrar" onchange="MostrarSenha()">
                                    <label for="mostrar"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <div id="btn_continuar" onclick="cancelarContratacao()" class="ui primary right labeled icon button">Continuar <i class="checkmark icon"></i></div>
                    </div>
                </div>
                <div id="mdl_erro" class="ui small modal">
                    <i class="close icon"></i>
                    <div id="erro_header" class="header">Alerta</div>
                    <div id="erro_content" class="content"></div>
                    <div class="actions">
                        <div class="ui cancel secondary button">Cancelar</div>
                    </div>
                </div>
        	</div>
        </div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/meu_plano.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>