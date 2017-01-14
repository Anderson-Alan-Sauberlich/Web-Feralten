<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require_once('config.php');
	require_once('vendor/autoload.php');
	
	$app = new \Slim\App();
	
	$app->group('/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pagina_inicial.php');
			
			$pagina_inicial = new application\controller\Pagina_Inicial();
			
			$pagina_inicial->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/menu-pesquisa/', function() use ($app) {
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			$menu_pesquisa = new application\controller\include_page\Menu_Pesquisa();
			
			$menu_pesquisa->Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			$menu_pesquisa = new application\controller\include_page\Menu_Pesquisa();
				
			$menu_pesquisa->Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			$menu_pesquisa = new application\controller\include_page\Menu_Pesquisa();
				
			$menu_pesquisa->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
	});
	
	$app->group('/usuario/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$login = new application\controller\usuario\Login();
			
			$login->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$login = new application\controller\usuario\Login();
				
			$resposta = $login->Autenticar_Usuario_Login();
			
			if ($resposta) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('sair/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$login = new application\controller\usuario\Login();
				
			$login->LogOut();
			
			return $response->withRedirect('/usuario/login/');
		});
	});
	
	$app->group('/usuario/cadastro/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			$cadastro = new application\controller\usuario\Cadastro();
			
			$cadastro->Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			$cadastro = new application\controller\usuario\Cadastro();
				
			$resposta = $cadastro->Cadastrar_Usuario();
			
			if ($resposta) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
			
			$perfil = new application\controller\usuario\meu_perfil\Perfil();
			
			$resposta = $perfil->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('compatibilidade/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$resposta = $cadastrar->Carregar_Compatibilidade();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$resposta = $cadastrar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
				
			$resposta = $cadastrar->Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/{img}', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$cadastrar = new application\controller\usuario\meu_perfil\pecas\Cadastrar();
			
			$resposta = $cadastrar->Deletar_Imagem($args['img']);
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/visualizar/', function() use ($app) {
		$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
			
			$visualizar = new application\controller\usuario\meu_perfil\pecas\Visualizar();
			
			if (isset($args['categoria'])) {
				$visualizar->set_categoria($args['categoria']);
			}
			
			if (isset($args['marca'])) {
				$visualizar->set_marca($args['marca']);
			}
			
			if (isset($args['modelo'])) {
				$visualizar->set_modelo($args['modelo']);
			}
			
			if (isset($args['versao'])) {
				$visualizar->set_versao($args['versao']);
			}
			
			if (isset($_GET['ano_de'])) {
				$visualizar->set_ano_de($args['ano_de']);
			}
			
			if (isset($_GET['ano_ate'])) {
				$visualizar->set_ano_ate($args['ano_ate']);
			}
			
			if (isset($_GET['peca'])) {
				$visualizar->set_peca($args['peca']);
			}
			
			$resposta = $visualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta === 'erro') {
				return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/atualizar.php');
		
			$atualizar = new application\controller\usuario\meu_perfil\pecas\Atualizar();
			
			$resposta = $atualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/boleto-atual/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/boleto_atual.php');
			
			$boleto_atual = new application\controller\usuario\meu_perfil\financeiro\Boleto_Atual();
			
			$resposta = $boleto_atual->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/boletos-pagos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/boletos_pagos.php');
			
			$boletos_pagos = new application\controller\usuario\meu_perfil\financeiro\Boletos_Pagos();
			
			$resposta = $boletos_pagos->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/financeiro/meu-plano/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/financeiro/meu_plano.php');
			
			$meu_plano = new application\controller\usuario\meu_perfil\financeiro\Meu_Plano();
			
			$resposta = $meu_plano->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
			
			$resposta = $atualizar->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$resposta = $atualizar->Verificar_Evento();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$resposta = $atualizar->Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$atualizar = new application\controller\usuario\meu_perfil\meus_dados\Atualizar();
				
			$resposta = $atualizar->Deletar_Imagem();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/alterar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
			
			$resposta = $alterar_senha->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			$alterar_senha = new application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha();
				
			$resposta = $alterar_senha->Atualizar_Senha_Usuario();
			
			if ($resposta === 'certo') {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/enderecos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
			
			$resposta = $enderecos->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('cidades/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
				
			$resposta = $enderecos->Retornar_Cidades_Por_Estado();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});

		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$enderecos = new application\controller\usuario\meu_perfil\meus_dados\Enderecos();
				
			$resposta = $enderecos->Atualizar_Endereco();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/meus-dados/concluir/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
			
			$resposta = $concluir->Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 0) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('cidades/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$resposta = $concluir->Retornar_Cidades_Por_Estado();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$resposta = $concluir->Deletar_Imagem();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$resposta = $concluir->Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$concluir = new application\controller\usuario\meu_perfil\meus_dados\Concluir();
				
			$resposta = $concluir->Concluir_Cadastro();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta === 'certo') {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/quem-somos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/quem_somos.php');
			
			$quem_somos = new application\controller\Quem_Somos();
			
			$quem_somos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/usuario/recuperar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/recuperar_senha.php');
			
			$recuperar_senha = new application\controller\usuario\Recuperar_Senha();
			
			$recuperar_senha->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/documentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/documentacao.php');
			
			$documentacao = new application\controller\Documentacao();
			
			$documentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/perguntas-frequentes/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/perguntas_frequentes.php');
			
			$perguntas_frequentes = new application\controller\Perguntas_Frequentes();
			
			$perguntas_frequentes->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/apresentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/apresentacao.php');
				
			$apresentacao = new application\controller\dicas_de_venda\Apresentacao();
			
			$apresentacao->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/principais/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/principais.php');
			
			$principais = new application\controller\dicas_de_venda\Principais();
			
			$principais->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/contato/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/contato.php');
			
			$contato = new application\controller\Contato();
			
			$contato->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pesquisa-avancada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pesquisa_avancada.php');
			
			$pesquisa_avancada = new application\controller\Pesquisa_Avancada();
			
			$pesquisa_avancada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/busca-programada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/busca_programada.php');
			
			$busca_programada = new application\controller\pecas\Busca_Programada();
			
			$busca_programada->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/mais-visualizados/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/mais_visualizados.php');
			
			$mais_visualizados = new application\controller\pecas\Mais_Visualizados();
			
			$mais_visualizados->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/venda-segura/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/venda_segura.php');
			
			$venda_segura = new application\controller\dicas_de_venda\Venda_Segura();
			
			$venda_segura->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/resultados/', function() use ($app) {
		$app->get('[{categoria}/[{marca}/[{modelo}/[{versao}/]]]]', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
			
			$resultados = new application\controller\pecas\Resultados();
			
			$resultados->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/publicidade/experimentar-formatos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/publicidade/experimentar_formatos.php');
			
			$experimentar_formatos = new application\controller\publicidade\Experimentar_Formatos();
			
			$experimentar_formatos->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/login.php');
			
			$login = new application\controller\admin\Login();
			
			$login->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
				
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
				
			$cadastrar->Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('marcas/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
				
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
				
			$cadastrar->Retornar_Marcas_Por_Categoria();
				
			return $response;
		});
		
		$app->get('modelos/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
				
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
				
			$cadastrar->Retornar_Modelos_Por_Marca();
				
			return $response;
		});
		
		$app->get('versoes/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$cadastrar->Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Cadastrar();
			
			$cadastrar->Cadastrar_CMMV();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/atualizar.php');
			
			$atualizar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Atualizar();
			
			$atualizar->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/cmmv/deletar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/cmmv/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\cmmv\Deletar();
			
			$deletar->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/cadastrar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/cadastrar.php');
			
			$cadastrar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Cadastrar();
			
			$cadastrar->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/atualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/atualizar.php');
			
			$atualizar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Atualizar();
			
			$atualizar->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/admin/controle/base-de-conhecimento/compatibilidade/deletar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/admin/controle/base_de_conhecimento/compatibilidade/deletar.php');
			
			$deletar = new application\controller\admin\controle\base_de_conhecimento\compatibilidade\Deletar();
			
			$deletar->Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->run();
?>