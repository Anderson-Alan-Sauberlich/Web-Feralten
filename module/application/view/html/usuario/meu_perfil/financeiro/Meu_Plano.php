<?php use module\application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
    <script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/meu_plano.js"></script>
	<title>Meu Plano | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Meu_Plano::Incluir_Menu_Usuario(); ?>
        <div class="ui secondary segment">
            <div class="ui doubling raised inverted grey stackable link three cards">
            	<div onclick="bnt_plano(1);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Orçamentos</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>1 Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_1" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(1); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(1); ?></button>
                    </div>
            	</div>
            	<div onclick="bnt_plano(2);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Até 10</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos Gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_2" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(2); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(2); ?></button>
                    </div>
            	</div>
            	<div onclick="bnt_plano(3);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Até 100</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos Gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_3" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(3); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(3); ?></button>
                    </div>
            	</div>
            	<div onclick="bnt_plano(4);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Até 1.000</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos Gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_4" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(4); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(4); ?></button>
                    </div>
            	</div>
            	<div onclick="bnt_plano(5);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Até 5.000</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos Gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_5" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(5); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(5); ?></button>
                    </div>
            	</div>
            	<div onclick="bnt_plano(6);" class="card">
            		<div class="content">
            			<div class="center aligned header">
            				<h1>Até 10.000</h1>
            			</div>
            			<div class="center aligned meta">
            				<h3>Peças</h3>
            			</div>
            		</div>
            		<div class="content">
            			<div class="description">
            				<p>Orçamentos Gratuitos</p>
            				<p>R$: 1,00 por anúncio excedente</p>
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
                       	<button id="bnt_plano_6" class="ui fluid massive button <?php View_Meu_Plano::Mostrar_Class_Plano_Ativo(6); ?>"><?php View_Meu_Plano::Mostrar_Texto_Plano_Ativo(6); ?></button>
                    </div>
            	</div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
        <img class="ui image" src="/resources/img/formaspagamento.png" width="883" height="39" />
        <div id="mdl_msg" class="ui mini modal">
        	<i class="close icon"></i>
            <div id="msg_header" class="header">Alerta</div>
            <div id="msg_content" class="content"></div>
            <div class="actions">
    			<button class="ui black deny button">Okay</button>
        	</div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>