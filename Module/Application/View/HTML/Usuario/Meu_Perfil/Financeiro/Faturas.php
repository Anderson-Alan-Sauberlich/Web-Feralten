<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Faturas as View_Faturas; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Faturas | Feralten</title>
</head>
<body>
    <header>
        <?php View_Faturas::Incluir_Menu_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <?php if (View_Faturas::Verificar_Fatura('fechada')) { ?>
            <div class="ui raised segment">
            	<div class="ui stackable doubling five column internally celled grid">
                    <div class="center aligned column">
                    	<h4>Abertura</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Abertura('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Vencimento</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Vencimento('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Fechamento</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Fechamento('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Status</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Status('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Valor Total</h4>
                        <div class="ui mini statistic">
                            <div class="content">R$: <?php View_Faturas::Mostrar_Total('fechada'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="ui accordion">
                    <div id="title_fatura_fechada" class="title ui horizontal divider active"><i class="icon dropdown"></i>Detalhes</div>
                    <div id="content_fatura_fechada" class="content active">
                        SERVIÇOS:
                        <div class="ui relaxed large celled list">
                        	<?php if (!empty(View_Faturas::Retornar_Lista_Fatura_Servicos('fechada'))) { ?>
                            	<?php foreach (View_Faturas::Retornar_Lista_Fatura_Servicos('fechada') as $fatura_servicos) { ?>
                                	<div class="item">
                                		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo number_format($fatura_servicos->get_valor(), 2, ',', '.'); ?></div>
                                		<div class="content">Mensal, <?php View_Faturas::Mostrar_Abertura('fechada'); ?> até <?php View_Faturas::Mostrar_Fechamento('fechada'); ?></div>
                                	</div>
                            	<?php } ?>
                        	<?php } ?>
                        </div>
                        <?php if (View_Faturas::Verificar_Valor_Fatura('fechada')) { ?>
                            <div class="ui pointing secondary three item menu" role="tablist">
                                <a data-tab="credito" class="active red item" role="tab">Cartão de Crédito</a>
                                <a data-tab="boleto" class="red item" role="tab">Boleto Bancario</a>
                            </div>
                            <div id="credito" class="ui bottom attached active tab" data-tab="credito" role="tabpanel">
                                <div class="ui stackable three column centered grid">
                                    <div class="column">
                                        <form class="ui form">
                                        	<div class="required field">
                                        		<label for="numero">Número do cartão</label>
                                        		<input id="numero" name="numero" placeholder="(ex.: 0000 0000 0000 0000)" type="text">
                                        	</div>
                                        	<div class="required field">
                                        		<label for="nome">Nome como está no cartão</label>
                                        		<input id="name" name="name" placeholder="Exatamente como está no cartão" type="text">
                                        	</div>
                                        	<div class="ten wide required field">
                                        		<label for="codigo">Código de Segurança</label>
                                        		<input id="codigo" name="codigo" placeholder="Geralente está no verso do cartão e tem de 3 a 4 digitos" type="text">
                                        	</div>
                                        	<div class="ten wide required field">
                                            	<label>Validade</label>
                                            	<div class="two fields">
                                                	<div class="field">
                                                		<select id="validade_mes" name="validade_mes" class="ui fluid scrolling search selection dropdown">
                                                			<option value="0">Mês</option>
                                                			<option value="01">01</option>
                                                			<option value="02">02</option>
                                                			<option value="03">03</option>
                                                			<option value="04">04</option>
                                                			<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
                                                		</select>
                                                	</div>
                                                	<div class="field">
                                                		<select id="validade_ano" name="validade_ano" class="ui fluid scrolling search selection dropdown">
                                                			<option value="0">Ano</option>
                                                			<?php View_Faturas::Carregar_Ano_Validade(); ?>
                                                		</select>
                                                	</div>
                                            	</div>
                                            </div>
                                            <div class="required field">
                                        		<label for="cpf">CPF</label>
                                        		<input id="cpf" name="cpf" placeholder="Digite apenas os numeros" type="text">
                                        	</div>
                                        	<div class="required field">
                                        		<label>Data de nascimento</label>
                                        		<div class="three fields">
                                        			<div class="field">
                                                		<select id="nascimento_dia" name="nascimento_dia" class="ui fluid scrolling search selection dropdown">
                                                			<option value="0">Dia</option>
                                                			<option value="01">01</option>
                                                			<option value="02">02</option>
                                                			<option value="03">03</option>
                                                			<option value="04">04</option>
                                                			<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
                                                			<option value="13">13</option>
                                                			<option value="14">14</option>
                                                			<option value="15">15</option>
                                                			<option value="16">16</option>
                                                			<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
                                                			<option value="25">25</option>
                                                			<option value="26">26</option>
                                                			<option value="27">27</option>
                                                			<option value="28">28</option>
                                                			<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
                                                		</select>
                                                	</div>
                                        			<div class="field">
                                                		<select id="nascimento_mes" name="nascimento_mes" class="ui fluid scrolling search selection dropdown">
                                                			<option value="0">Mês</option>
                                                			<option value="01">01</option>
                                                			<option value="02">02</option>
                                                			<option value="03">03</option>
                                                			<option value="04">04</option>
                                                			<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
                                                		</select>
                                                	</div>
                                                	<div class="field">
                                                		<select id="nascimento_ano" name="nascimento_ano" class="ui fluid scrolling search selection dropdown">
                                                			<option value="0">Ano</option>
                                                			<?php View_Faturas::Carregar_Anos(); ?>
                                                		</select>
                                                	</div>
                                        		</div>
                                        	</div>
                                        	<div class="ui blue big fluid button" type="submit">Continuar</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="boleto" class="ui bottom attached tab " data-tab="boleto" role="tabpanel">
                            	<div class="margem-superior-pouco"></div>
                            	<div class="ui stackable three column centered grid">
                                    <div class="column">
                                    	<button class="ui blue big fluid button">Gerar Boleto</button>
                                    </div>
                                </div>
                                <div class="margem-inferior-pouco"></div>
                            </div>
                        <?php } else { ?>
                        	<h1>Grátis</h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (View_Faturas::Verificar_Fatura('aberta')) { ?>
            <div class="ui secondary segment">
            	<div class="ui stackable doubling five column internally celled grid">
                    <div class="center aligned column">
                    	<h4>Abertura</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Abertura('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Vencimento</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Vencimento('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Fechamento</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Fechamento('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Status</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Faturas::Mostrar_Status('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Valor Total</h4>
                    	<div class="ui mini statistic">
                            <div class="content">R$: <?php View_Faturas::Mostrar_Total('aberta'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="ui accordion">
                    <div id="title_fatura_aberta" class="title ui horizontal divider"><i class="icon dropdown"></i>Detalhes</div>
                    <div id="content_fatura_aberta" class="content">
                        SERVIÇOS:
                        <div class="ui relaxed large celled list">
                        	<?php if (!empty(View_Faturas::Retornar_Lista_Fatura_Servicos('aberta'))) { ?>
                            	<?php foreach (View_Faturas::Retornar_Lista_Fatura_Servicos('aberta') as $fatura_servicos) { ?>
                                	<div class="item">
                                		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo number_format($fatura_servicos->get_valor(), 2, ',', '.'); ?></div>
                                		<div class="content">Mensal, <?php View_Faturas::Mostrar_Abertura('aberta'); ?> até <?php View_Faturas::Mostrar_Fechamento('aberta'); ?></div>
                                	</div>
                            	<?php } ?>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if (!View_Faturas::Verificar_Fatura('fechada')) { echo '<h3>Erro: Nenhuma fatura encontrada em aberto</h3>'; } ?>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
    	<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/faturas.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>