<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require_once('config.php');
	require_once('vendor/autoload.php');
	
	$config['displayErrorDetails'] = true;
	
	$app = new \Slim\App(["settings" => $config]);
	
	$app->group('/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pagina_inicial.php');
			
			application\controller\Pagina_Inicial::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/menu-pesquisa/', function() use ($app) {
		$app->get('marca/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			application\controller\include_page\Menu_Pesquisa::Retornar_Marcas_Por_Categoria();
			
			return $response;
		});
		
		$app->get('modelo/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			application\controller\include_page\Menu_Pesquisa::Retornar_Modelos_Por_Marca();
			
			return $response;
		});
		
		$app->get('versao/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/include_page/menu_pesquisa.php');
			
			application\controller\include_page\Menu_Pesquisa::Retornar_Versoes_Por_Modelo();
			
			return $response;
		});
	});
	
	$app->group('/usuario/login/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			application\controller\usuario\Login::Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			$resposta = application\controller\usuario\Login::Autenticar_Usuario_Login();
			
			if ($resposta) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('sair/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/login.php');
			
			application\controller\usuario\Login::LogOut();
			
			return $response->withRedirect('/usuario/login/');
		});
	});
	
	$app->group('/usuario/cadastro/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			application\controller\usuario\Cadastro::Carregar_Pagina();
			
			return $response;
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/cadastro.php');
			
			$resposta = application\controller\usuario\Cadastro::Cadastrar_Usuario();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\Perfil::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Cadastrar::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Cadastrar::Carregar_Compatibilidade();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Cadastrar::Verificar_Evento();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Cadastrar::Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/{img}', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/cadastrar.php');
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Cadastrar::Deletar_Imagem($args['img']);
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
	});
	
	$app->group('/usuario/meu-perfil/pecas/visualizar/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
		
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
		
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/{modelo}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/{ano_ate}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
				
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
				
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else if ($resposta != 1) {
				return $response->withRedirect('/usuario/meu-perfil/');
			} else {
				return $response;
			}
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/{ano_ate}/{peca}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php');
			
			$resposta = application\controller\usuario\meu_perfil\pecas\Visualizar::Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
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
		
			$resposta = application\controller\usuario\meu_perfil\pecas\Atualizar::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\financeiro\Boleto_Atual::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\financeiro\Boletos_Pagos::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\financeiro\Meu_Plano::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Atualizar::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Atualizar::Verificar_Evento();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Atualizar::Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/atualizar.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Atualizar::Deletar_Imagem();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha::Carregar_Pagina();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/alterar_senha.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Alterar_Senha::Atualizar_Senha_Usuario();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Enderecos::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Enderecos::Retornar_Cidades_Por_Estado();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});

		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/enderecos.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Enderecos::Atualizar_Endereco();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Concluir::Carregar_Pagina();
			
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
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Concluir::Retornar_Cidades_Por_Estado();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->delete('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Concluir::Deletar_Imagem();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('imagem/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Concluir::Salvar_Imagem_TMP();
			
			if ($resposta === false) {
				return $response->withRedirect('/usuario/login/');
			} else {
				return $response;
			}
		});
		
		$app->post('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/meu_perfil/meus_dados/concluir.php');
			
			$resposta = application\controller\usuario\meu_perfil\meus_dados\Concluir::Concluir_Cadastro();
			
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
			
			application\controller\Quem_Somos::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/usuario/recuperar-senha/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/usuario/recuperar_senha.php');
			
			application\controller\usuario\Recuperar_Senha::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/documentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/documentacao.php');
			
			application\controller\Documentacao::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/perguntas-frequentes/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/perguntas_frequentes.php');
			
			application\controller\Perguntas_Frequentes::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/apresentacao/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/apresentacao.php');
				
			application\controller\dicas_de_venda\Apresentacao::Carregar_Pagina();
					
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/principais/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/principais.php');
			
			application\controller\dicas_de_venda\Principais::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/contato/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/contato.php');
			
			application\controller\Contato::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pesquisa-avancada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pesquisa_avancada.php');
			
			application\controller\Pesquisa_Avancada::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/busca-programada/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/busca_programada.php');
			
			application\controller\pecas\Busca_Programada::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/mais-visualizados/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/mais_visualizados.php');
			
			application\controller\pecas\Mais_Visualizados::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/dicas-de-venda/venda-segura/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/dicas_de_venda/venda_segura.php');
			
			application\controller\dicas_de_venda\Venda_Segura::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/pecas/resultados/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
		
			application\controller\pecas\Resultados::Carregar_Pagina();
		
			return $response;
		});
		
		$app->get('{categoria}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
		
			application\controller\pecas\Resultados::Carregar_Pagina();
		
			return $response;
		});
		
		$app->get('{categoria}/{marca}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
				
			application\controller\pecas\Resultados::Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('{categoria}/{marca}/{modelo}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
				
			application\controller\pecas\Resultados::Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
				
			application\controller\pecas\Resultados::Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
				
			application\controller\pecas\Resultados::Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/{ano_ate}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
				
			application\controller\pecas\Resultados::Carregar_Pagina();
				
			return $response;
		});
		
		$app->get('{categoria}/{marca}/{modelo}/{versao}/{ano_de}/{ano_ate}/{peca}/', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/pecas/resultados.php');
			
			application\controller\pecas\Resultados::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->group('/publicidade/experimentar-formatos/', function() use ($app) {
		$app->get('', function(Request $request, Response $response, $args) use ($app) {
			require_once(RAIZ.'/application/controller/publicidade/experimentar_formatos.php');
			
			application\controller\publicidade\Experimentar_Formatos::Carregar_Pagina();
			
			return $response;
		});
	});
	
	$app->run();
?>