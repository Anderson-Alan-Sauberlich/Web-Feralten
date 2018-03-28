<?php
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    $app = new \Slim\App();
    
    $app->group('', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $inicio = new Module\Application\Controller\Inicio();
            
            $inicio->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/layout', function() use ($app) {
        $app->group('/menu', function() use ($app) {
            $app->group('/filtro', function() use ($app) {
                $app->get('/cidades[/]', function(Request $request, Response $response, $args) use ($app) {
                    $menu_filtro = new Module\Application\Controller\Layout\Menu\Filtro();
                    
                    if (isset($_GET['estado'])) {
                        $menu_filtro->set_estado($_GET['estado']);
                    }
                    
                    $menu_filtro->Retornar_Cidades_Por_Estado();
                    
                    return $response;
                });
            });
            
            $app->group('/pesquisa', function() use ($app) {
                $app->get('/marca[/]', function(Request $request, Response $response, $args) use ($app) {
                    $menu_pesquisa = new Module\Application\Controller\Layout\Menu\Pesquisa();
                    
                    if (isset($_GET['categoria'])) {
                        $menu_pesquisa->set_categoria($_GET['categoria']);
                    }
                    
                    $menu_pesquisa->Retornar_Marcas_Por_Categoria();
                    
                    return $response;
                });
                
                $app->get('/modelo[/]', function(Request $request, Response $response, $args) use ($app) {
                    $menu_pesquisa = new Module\Application\Controller\Layout\Menu\Pesquisa();
                    
                    if (isset($_GET['marca'])) {
                        $menu_pesquisa->set_marca($_GET['marca']);
                    }
                    
                    $menu_pesquisa->Retornar_Modelos_Por_Marca();
                    
                    return $response;
                });
                
                $app->get('/versao[/]', function(Request $request, Response $response, $args) use ($app) {
                    $menu_pesquisa = new Module\Application\Controller\Layout\Menu\Pesquisa();
                    
                    if (isset($_GET['modelo'])) {
                        $menu_pesquisa->set_modelo($_GET['modelo']);
                    }
                    
                    $menu_pesquisa->Retornar_Versoes_Por_Modelo();
                    
                    return $response;
                });
            });
            
            $app->group('/orcamento', function() use ($app) {
                $app->get('/numeros[/]', function(Request $request, Response $response, $args) use ($app) {
                    $orcamento = new Module\Application\Controller\Layout\Menu\Orcamento();
                    
                    $orcamento->Atualizar_Numeros();
                    
                    return $response;
                });
            });
        });
        
        $app->group('/modal', function() use ($app) {
            $app->group('/solicitar-orcamento', function() use ($app) {
                $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                    $solicitar_orcamento = new Module\Application\Controller\Layout\Modal\Solicitar_Orcamento();
                    
                    $solicitar_orcamento->set_categoria_id(isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null);
                    $solicitar_orcamento->set_marca_id(isset($_POST['marca_id']) ? $_POST['marca_id'] : null);
                    $solicitar_orcamento->set_modelo_id(isset($_POST['modelo_id']) ? $_POST['modelo_id'] : null);
                    $solicitar_orcamento->set_versao_id(isset($_POST['versao_id']) ? $_POST['versao_id'] : null);
                    $solicitar_orcamento->set_ano_de(isset($_POST['ano_de']) ? $_POST['ano_de'] : null);
                    $solicitar_orcamento->set_ano_ate(isset($_POST['ano_ate']) ? $_POST['ano_ate'] : null);
                    $solicitar_orcamento->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                    $solicitar_orcamento->set_descricao(isset($_POST['descricao']) ? $_POST['descricao'] : null);
                    $solicitar_orcamento->set_estado_uso(isset($_POST['estado_uso']) ? $_POST['estado_uso'] : null);
                    $solicitar_orcamento->set_numero_serie(isset($_POST['numero_serie']) ? $_POST['numero_serie'] : null);
                    $solicitar_orcamento->set_preferencia_entrega(isset($_POST['preferencia_entrega']) ? $_POST['preferencia_entrega'] : null);
                    
                    $solicitar_orcamento->Criar_Orcamento();
                });
            });
        });
        
        $app->group('/form', function() use ($app) {
            $app->group('/contato', function() use ($app) {
                $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                    $contato = new Module\Application\Controller\Layout\Form\Contato();
                    
                    $contato->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                    $contato->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                    $contato->set_telefone(isset($_POST['telefone']) ? $_POST['telefone'] : null);
                    $contato->set_whatsapp(isset($_POST['whatsapp']) ? $_POST['whatsapp'] : null);
                    $contato->set_assunto(isset($_POST['assunto']) ? $_POST['assunto'] : null);
                    $contato->set_mensagem(isset($_POST['mensagem']) ? $_POST['mensagem'] : null);
                    
                    $contato->Enviar_Email();
                    
                    return $response;
                });
            });
            
            $app->group('/contato-anunciante', function() use ($app) {
                $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                    $contato_anunciante = new Module\Application\Controller\Layout\Form\Contato_Anunciante();
                    
                    $contato_anunciante->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                    $contato_anunciante->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                    $contato_anunciante->set_telefone(isset($_POST['telefone']) ? $_POST['telefone'] : null);
                    $contato_anunciante->set_whatsapp(isset($_POST['whatsapp']) ? $_POST['whatsapp'] : null);
                    $contato_anunciante->set_mensagem(isset($_POST['mensagem']) ? $_POST['mensagem'] : null);
                    $contato_anunciante->set_peca_id(isset($_POST['peca_id']) ? $_POST['peca_id'] : null);
                    
                    $contato_anunciante->Enviar_Email();
                    
                    return $response;
                });
            });
        });
        
        $app->group('/elemento', function() use ($app) {
            $app->group('/card-peca', function() use ($app) {
                $app->post('/opcoes[/]', function(Request $request, Response $response, $args) use ($app) {
                    $card_peca = new Module\Application\Controller\Layout\Elemento\Card_Peca();
                    
                    if (isset($_POST['peca'])) {
                        $card_peca->set_peca($_POST['peca']);
                    }
                    
                    if (isset($_POST['deletar'])) {
                        $card_peca->set_deletar($_POST['deletar']);
                    }
                    
                    if (isset($_POST['status'])) {
                        $card_peca->set_status($_POST['status']);
                    }
                    
                    $card_peca->Salvar_Alteracoes_Peca();
                    
                    return $response;
                });
            });
            
            $app->group('/orcamento', function() use ($app) {
                $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                    $orcamento = new Module\Application\Controller\Layout\Elemento\Orcamento();
                    
                    $orcamento->set_id_orcamento(isset($_POST['id_orcamento']) ? $_POST['id_orcamento'] : null);
                    
                    $orcamento->SetarOrcamentoNaoTenho();
                    
                    return $response;
                });
            });
        });
    });
    
    $app->group('/usuario', function() use ($app) {
        $app->group('/login', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Application\Controller\Usuario\Login();
                
                $login->Carregar_Pagina();
                
                return $response;
            });
            
            $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Application\Controller\Usuario\Login();
                
                $login->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                $login->set_senha(isset($_POST['password']) ? $_POST['password'] : null);
                $login->set_manter_login(isset($_POST['manter_login']) ? true : null);
                
                $resposta = $login->Autenticar_Usuario_Login();
                
                if ($resposta) {
                    return $response->withRedirect('/usuario/meu-perfil/');
                } else {
                    return $response;
                }
            });
            
            $app->post('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Application\Controller\Usuario\Login();
                
                $login->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                $login->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
                $login->set_manter_login(isset($_POST['manter']) ? true : null);
                
                $resposta = $login->Autenticar_Usuario_Login_Ajax();
                
                return $response;
            });
            
            $app->get('/sair[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Application\Controller\Usuario\Login();
                
                $login->set_logout(isset($_GET['logout']) ? $_GET['logout'] : null);
                
                $login->LogOut();
                
                return $response->withRedirect('/usuario/login/');
            });
        });
        
        $app->group('/cadastro', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $cadastro = new Module\Application\Controller\Usuario\Cadastro();
                
                $cadastro->Carregar_Pagina();
                
                return $response;
            });
            
            $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                $cadastro = new Module\Application\Controller\Usuario\Cadastro();
                    
                $cadastro->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                $cadastro->set_sobrenome(isset($_POST['sobrenome']) ? $_POST['sobrenome'] : null);
                $cadastro->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                $cadastro->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
                $cadastro->set_recaptcha_response(isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null);
                
                $resposta = $cadastro->Cadastrar_Usuario();
                
                if ($resposta) {
                    return $response->withRedirect('/usuario/meu-perfil/');
                } else {
                    return $response;
                }
            });
            
            $app->post('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                $cadastro = new Module\Application\Controller\Usuario\Cadastro();
                    
                $cadastro->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                $cadastro->set_sobrenome(isset($_POST['sobrenome']) ? $_POST['sobrenome'] : null);
                $cadastro->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                $cadastro->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
                $cadastro->set_recaptcha_response(isset($_POST['token']) ? $_POST['token'] : null);
                
                $cadastro->Cadastrar_Usuario_Ajax();
                
                return $response;
            });
        });
        
        $app->group('/recuperar-senha', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $recuperar_senha = new Module\Application\Controller\Usuario\Recuperar_Senha();
                
                if (isset($_GET['codigo'])) {
                    $recuperar_senha->set_codigo($_GET['codigo']);
                }
                
                $recuperar_senha->Carregar_Pagina();
                
                return $response;
            });
            
            $app->post('/enviar/', function(Request $request, Response $response, $args) use ($app) {
                $recuperar_senha = new Module\Application\Controller\Usuario\Recuperar_Senha();
                
                $recuperar_senha->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                
                $recuperar_senha->Enviar_Link_Email();
                
                return $response;
            });
            
            $app->post('/salvar[/]', function(Request $request, Response $response, $args) use ($app) {
                $recuperar_senha = new Module\Application\Controller\Usuario\Recuperar_Senha();
                
                $recuperar_senha->set_codigo(isset($_POST['codigo']) ? $_POST['codigo'] : null);
                $recuperar_senha->set_senha_nova(isset($_POST['senha_nova']) ? $_POST['senha_nova'] : null);
                $recuperar_senha->set_senha_confnova(isset($_POST['senha_confnova']) ? $_POST['senha_confnova'] : null);
                
                $recuperar_senha->Salvar_Senha();
                
                return $response;
            });
        });        
        
        $app->group('/meu-perfil', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $perfil = new Module\Application\Controller\Usuario\Meu_Perfil\Perfil();
                
                $resposta = $perfil->Carregar_Pagina();
                
                if ($resposta === false) {
                    return $response->withRedirect('/usuario/login/');
                } else {
                    return $response;
                }
            });
            
            $app->group('/perfil', function() use ($app) {
                $app->get('/visualizado[/]', function(Request $request, Response $response, $args) use ($app) {
                    $perfil = new Module\Application\Controller\Usuario\Meu_Perfil\Perfil();
                    
                    $perfil->Retornar_Valores_Visualizados();
                    
                    return $response;
                });
                
                $app->get('/adicionado[/]', function(Request $request, Response $response, $args) use ($app) {
                    $perfil = new Module\Application\Controller\Usuario\Meu_Perfil\Perfil();
                    
                    $perfil->Retornar_Valores_Adicionados();
                    
                    return $response;
                });
                
                $app->get('/removido[/]', function(Request $request, Response $response, $args) use ($app) {
                    $perfil = new Module\Application\Controller\Usuario\Meu_Perfil\Perfil();
                    
                    $perfil->Retornar_Valores_Removidos();
                    
                    return $response;
                });
            });
            
            $app->group('/orcamentos', function() use ($app) {
                $app->group('/meus-orcamentos', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $meus_orcamentos = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos();
                        
                        $resposta = $meus_orcamentos->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->get('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                        $meus_orcamentos = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos();
                        
                        $meus_orcamentos->set_indice(isset($_GET['indice']) ? $_GET['indice'] : null);
                        
                        $meus_orcamentos->Carregar_Meus_Orcamentos();
                        
                        return $response;
                    });
                });
                
                $app->group('/caixa-de-entrada', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $caixa_de_entrada = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Caixa_De_Entrada();
                        
                        $resposta = $caixa_de_entrada->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->get('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                        $caixa_de_entrada = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Caixa_De_Entrada();
                        
                        $caixa_de_entrada->set_indice(isset($_GET['indice']) ? $_GET['indice'] : null);
                        
                        $caixa_de_entrada->Carregar_Orcamentos_Recebidos();
                        
                        return $response;
                    });
                });
                
                $app->group('/respondidos', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $respondidos = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Respondidos();
                        
                        $resposta = $respondidos->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->get('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                        $respondidos = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Respondidos();
                        
                        $respondidos->set_indice(isset($_GET['indice']) ? $_GET['indice'] : null);
                        
                        $respondidos->Carregar_Orcamentos_Recebidos();
                        
                        return $response;
                    });
                });
                
                $app->group('/nao-tenho', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $nao_tenho = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Nao_Tenho();
                        
                        $resposta = $nao_tenho->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->get('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
                        $nao_tenho = new Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos\Nao_Tenho();
                        
                        $nao_tenho->set_indice(isset($_GET['indice']) ? $_GET['indice'] : null);
                        
                        $nao_tenho->Carregar_Orcamentos_NaoTenho();
                        
                        return $response;
                    });
                });
            });
            
            $app->group('/pecas', function() use ($app) {
                $app->group('/cadastrar', function() use ($app) {
                    $app->get('[/[no-orcamento/{id_orcamento}[/]]]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        if (isset($args['id_orcamento'])) {
                            $cadastrar->set_orcamento_id($args['id_orcamento']);
                        }
                        
                        $resposta = $cadastrar->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->get('/dados[/]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        $cadastrar->Retornar_Dados_Plano();
                        
                        return $response;
                    });
                    
                    $app->get('/compatibilidade[/]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        if (isset($_GET['categoria'])) {
                            $cadastrar->set_categoria($_GET['categoria']);
                        }
                        
                        if (isset($_GET['marca'])) {
                            $cadastrar->set_marca($_GET['marca']);
                        }
                        
                        if (isset($_GET['modelo'])) {
                            $cadastrar->set_modelo($_GET['modelo']);
                        }
                        
                        if (isset($_GET['versao'])) {
                            $cadastrar->set_versao($_GET['versao']);
                        }
                        
                        $cadastrar->Carregar_Compatibilidade();
                        
                        return $response;
                    });
                    
                    $app->post('[/[no-orcamento/{id_orcamento}[/]]]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        if (isset($args['id_orcamento'])) {
                            $cadastrar->set_orcamento_id($args['id_orcamento']);
                        }
                        
                        $cadastrar->set_categoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);
                        $cadastrar->set_marca(isset($_POST['marca']) ? $_POST['marca'] : null);
                        $cadastrar->set_modelo(isset($_POST['modelo']) ? $_POST['modelo'] : null);
                        $cadastrar->set_versao(isset($_POST['versao']) ? $_POST['versao'] : null);
                        $cadastrar->set_descricao(isset($_POST['descricao']) ? $_POST['descricao'] : null);
                        $cadastrar->set_estado_uso(isset($_POST['estado_uso']) ? $_POST['estado_uso'] : null);
                        $cadastrar->set_preferencia_entrega(isset($_POST['preferencia_entrega']) ? $_POST['preferencia_entrega'] : null);
                        $cadastrar->set_fabricante(isset($_POST['fabricante']) ? $_POST['fabricante'] : null);
                        $cadastrar->set_peca(isset($_POST['peca']) ? $_POST['peca'] : null);
                        $cadastrar->set_serie(isset($_POST['serie']) ? $_POST['serie'] : null);
                        $cadastrar->set_preco(isset($_POST['preco']) ? $_POST['preco'] : null);
                        
                        $resposta = $cadastrar->Cadastrar_Peca();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->post('/imagem[/]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        if (isset($_FILES['imagem1'])) {
                            $cadastrar->set_imagem($_FILES['imagem1'], 1);
                        }
                        
                        if (isset($_FILES['imagem2'])) {
                            $cadastrar->set_imagem($_FILES['imagem2'], 2);
                        }
                        
                        if (isset($_FILES['imagem3'])) {
                            $cadastrar->set_imagem($_FILES['imagem3'], 3);
                        }
                        
                        $cadastrar->Salvar_Imagem_TMP();
                        
                        return $response;
                    });
                    
                    $app->delete('/imagem/{img}[/]', function(Request $request, Response $response, $args) use ($app) {
                        $cadastrar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Cadastrar();
                        
                        $cadastrar->Deletar_Imagem($args['img']);
                        
                        return $response;
                    });
                });
                
                $app->group('/visualizar', function() use ($app) {
                    $app->group('/em', function() use ($app) {
                        $app->get('[/{estado}/{cidade}[/[{categoria}[/[{marca}[/[{modelo}[/[{versao}[/]]]]]]]]]]', function(Request $request, Response $response, $args) use ($app) {
                            $visualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Visualizar();
                            
                            if (isset($args['estado'])) {
                                $visualizar->set_estado_uf($args['estado']);
                            }
                            
                            if (isset($args['cidade'])) {
                                $visualizar->set_cidade_url($args['cidade']);
                            }
                            
                            if (isset($args['categoria'])) {
                                $visualizar->set_categoria_url($args['categoria']);
                            }
                            
                            if (isset($args['marca'])) {
                                $visualizar->set_marca_url($args['marca']);
                            }
                            
                            if (isset($args['modelo'])) {
                                $visualizar->set_modelo_url($args['modelo']);
                            }
                            
                            if (isset($args['versao'])) {
                                $visualizar->set_versao_url($args['versao']);
                            }
                            
                            if (isset($_GET['ano_de'])) {
                                $visualizar->set_ano_de($_GET['ano_de']);
                            }
                            
                            if (isset($_GET['ano_ate'])) {
                                $visualizar->set_ano_ate($_GET['ano_ate']);
                            }
                            
                            if (isset($_GET['peca'])) {
                                $visualizar->set_peca_nome($_GET['peca']);
                            }
                            
                            if (isset($_GET['pagina'])) {
                                $visualizar->set_pagina($_GET['pagina']);
                            }
                            
                            if (isset($_GET['ordem_preco'])) {
                                $visualizar->set_ordem_preco($_GET['ordem_preco']);
                            }
                            
                            if (isset($_GET['ordem_data'])) {
                                $visualizar->set_ordem_data($_GET['ordem_data']);
                            }
                            
                            if (isset($_GET['estado_uso'])) {
                                $visualizar->set_estado_uso_url($_GET['estado_uso']);
                            }
                            
                            if (isset($_GET['preferencia_entrega'])) {
                                $visualizar->set_preferencia_entrega_url($_GET['preferencia_entrega']);
                            }
                            
                            if (isset($_GET['status_peca'])) {
                                $visualizar->set_status_peca_url($_GET['status_peca']);
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
                    
                    $app->group('', function() use ($app) {
                        $app->get('[/[{categoria}[/[{marca}[/[{modelo}[/[{versao}[/]]]]]]]]]', function(Request $request, Response $response, $args) use ($app) {
                            $visualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Visualizar();
                            
                            if (isset($args['categoria'])) {
                                $visualizar->set_categoria_url($args['categoria']);
                            }
                            
                            if (isset($args['marca'])) {
                                $visualizar->set_marca_url($args['marca']);
                            }
                            
                            if (isset($args['modelo'])) {
                                $visualizar->set_modelo_url($args['modelo']);
                            }
                            
                            if (isset($args['versao'])) {
                                $visualizar->set_versao_url($args['versao']);
                            }
                            
                            if (isset($_GET['ano_de'])) {
                                $visualizar->set_ano_de($_GET['ano_de']);
                            }
                            
                            if (isset($_GET['ano_ate'])) {
                                $visualizar->set_ano_ate($_GET['ano_ate']);
                            }
                            
                            if (isset($_GET['peca'])) {
                                $visualizar->set_peca_nome($_GET['peca']);
                            }
                            
                            if (isset($_GET['pagina'])) {
                                $visualizar->set_pagina($_GET['pagina']);
                            }
                            
                            if (isset($_GET['ordem_preco'])) {
                                $visualizar->set_ordem_preco($_GET['ordem_preco']);
                            }
                            
                            if (isset($_GET['ordem_data'])) {
                                $visualizar->set_ordem_data($_GET['ordem_data']);
                            }
                            
                            if (isset($_GET['estado_uso'])) {
                                $visualizar->set_estado_uso_url($_GET['estado_uso']);
                            }
                            
                            if (isset($_GET['preferencia_entrega'])) {
                                $visualizar->set_preferencia_entrega_url($_GET['preferencia_entrega']);
                            }
                            
                            if (isset($_GET['status_peca'])) {
                                $visualizar->set_status_peca_url($_GET['status_peca']);
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
                });
                
                $app->group('/atualizar', function() use ($app) {
                    $app->get('/compatibilidade[/]', function(Request $request, Response $response, $args) use ($app) {
                        $atualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Atualizar();
                        
                        if (isset($_GET['categoria'])) {
                            $atualizar->set_categoria($_GET['categoria']);
                        }
                        
                        if (isset($_GET['marca'])) {
                            $atualizar->set_marca($_GET['marca']);
                        }
                        
                        if (isset($_GET['modelo'])) {
                            $atualizar->set_modelo($_GET['modelo']);
                        }
                        
                        if (isset($_GET['versao'])) {
                            $atualizar->set_versao($_GET['versao']);
                        }
                        
                        $atualizar->Carregar_Compatibilidade();
                        
                        return $response;
                    });
                    
                    $app->get('[/[{peca}[/]]]', function(Request $request, Response $response, $args) use ($app) {
                        $atualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Atualizar();
                        
                        $atualizar->set_peca_url(isset($args['peca']) ? $args['peca'] : null);
                        
                        $resposta = $atualizar->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta === 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else if ($resposta === 'erro') {
                            return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->delete('/imagem/{img}[/]', function(Request $request, Response $response, $args) use ($app) {
                        $atualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Atualizar();
                        
                        $atualizar->Deletar_Imagem($args['img']);
                        
                        return $response;
                    });
                    
                    $app->post('/imagem[/]', function(Request $request, Response $response, $args) use ($app) {
                        $atualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Atualizar();
                        
                        if (isset($_FILES['imagem1'])) {
                            $atualizar->set_imagem($_FILES['imagem1'], 1);
                        }
                        
                        if (isset($_FILES['imagem2'])) {
                            $atualizar->set_imagem($_FILES['imagem2'], 2);
                        }
                        
                        if (isset($_FILES['imagem3'])) {
                            $atualizar->set_imagem($_FILES['imagem3'], 3);
                        }
                        
                        $atualizar->Salvar_Imagem_TMP();
                        
                        return $response;
                    });
                    
                    $app->post('[/[{peca}[/]]]', function(Request $request, Response $response, $args) use ($app) {
                        $atualizar = new Module\Application\Controller\Usuario\Meu_Perfil\Pecas\Atualizar();
                        
                        $atualizar->set_categoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);
                        $atualizar->set_marca(isset($_POST['marca']) ? $_POST['marca'] : null);
                        $atualizar->set_modelo(isset($_POST['modelo']) ? $_POST['modelo'] : null);
                        $atualizar->set_versao(isset($_POST['versao']) ? $_POST['versao'] : null);
                        $atualizar->set_descricao(isset($_POST['descricao']) ? $_POST['descricao'] : null);
                        $atualizar->set_estado_uso(isset($_POST['estado_uso']) ? $_POST['estado_uso'] : null);
                        $atualizar->set_preferencia_entrega(isset($_POST['preferencia_entrega']) ? $_POST['preferencia_entrega'] : null);
                        $atualizar->set_fabricante(isset($_POST['fabricante']) ? $_POST['fabricante'] : null);
                        $atualizar->set_peca(isset($_POST['peca']) ? $_POST['peca'] : null);
                        $atualizar->set_serie(isset($_POST['serie']) ? $_POST['serie'] : null);
                        $atualizar->set_preco(isset($_POST['preco']) ? $_POST['preco'] : null);
                        $atualizar->set_peca_url(isset($args['peca']) ? $args['peca'] : null);
                        
                        $resposta = $atualizar->Verificar_Evento();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta === 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else if ($resposta === 'erro') {
                            return $response->withRedirect('/usuario/meu-perfil/pecas/visualizar/');
                        } else {
                            return $response;
                        }
                    });
                });
            });
            
            $app->group('/financeiro', function() use ($app) {                
                $app->group('/faturas', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $faturas = new Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas();
                        
                        $resposta = $faturas->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->group('/pagseguro', function() use ($app) {
                        $app->post('/credito[/]', function(Request $request, Response $response, $args) use ($app) {
                            $faturas = new Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas();
                            
                            $faturas->set_hash(isset($_POST['hash']) ? $_POST['hash'] : null);
                            $faturas->set_token(isset($_POST['token']) ? $_POST['token'] : null);
                            $faturas->set_ip(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
                            $faturas->set_cpf(isset($_POST['cpf']) ? $_POST['cpf'] : null);
                            $faturas->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                            $faturas->set_nascimento(isset($_POST['nascimento']) ? $_POST['nascimento'] : null);
                            
                            $faturas->PagarPagSeguroCredito();
                        });
                    });
                });
                
                $app->group('/historico', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $historico = new Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Historico();
                        
                        $resposta = $historico->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                });
                
                $app->group('/meu-plano', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $meu_plano = new Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Meu_Plano();
                        
                        $resposta = $meu_plano->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $meu_plano = new Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Meu_Plano();
                        
                        $meu_plano->set_plano_id(isset($_POST['plano']) ? $_POST['plano'] : null);
                        
                        $resposta = $meu_plano->Salvar_Novo_Plano();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else if ($resposta != 1) {
                            return $response->withRedirect('/usuario/meu-perfil/');
                        } else {
                            return $response;
                        }
                    });
                });
            });
            
            $app->group('/meus-dados', function() use ($app) {
                $app->group('/editar-dados', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $editar_dados = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados();
                        
                        $resposta = $editar_dados->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $editar_dados = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados();
                        
                        $editar_dados->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                        $editar_dados->set_sobrenome(isset($_POST['sobrenome']) ? $_POST['sobrenome'] : null);
                        $editar_dados->set_fone(isset($_POST['fone']) ? $_POST['fone'] : null);
                        $editar_dados->set_fone_alternativo(isset($_POST['fone_alternativo']) ? $_POST['fone_alternativo'] : null);
                        $editar_dados->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                        $editar_dados->set_email_alternativo(isset($_POST['email_alternativo']) ? $_POST['email_alternativo'] : null);
                        $editar_dados->set_cidade(isset($_POST['cidade']) ? $_POST['cidade'] : null);
                        $editar_dados->set_estado(isset($_POST['estado']) ? $_POST['estado'] : null);
                        $editar_dados->set_numero(isset($_POST['numero']) ? $_POST['numero'] : null);
                        $editar_dados->set_cep(isset($_POST['cep']) ? $_POST['cep'] : null);
                        $editar_dados->set_bairro(isset($_POST['bairro']) ? $_POST['bairro'] : null);
                        $editar_dados->set_rua(isset($_POST['rua']) ? $_POST['rua'] : null);
                        $editar_dados->set_complemento(isset($_POST['complemento']) ? $_POST['complemento'] : null);
                        $editar_dados->set_cpf_cnpj(isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : null);
                        $editar_dados->set_site(isset($_POST['site']) ? $_POST['site'] : null);
                        $editar_dados->set_nome_comercial(isset($_POST['nome_comercial']) ? $_POST['nome_comercial'] : null);
                        
                        $editar_dados->Concluir_Cadastro();
                        
                        return $response;
                    });
                    
                    $app->group('/usuario', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $usuario = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario();
                            
                            $usuario->CarregarDados();
                            
                            return $response;
                        });
                        
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $usuario = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario();
                            
                            $usuario->set_nome(isset($_POST['nome']) ? $_POST['nome'] : null);
                            $usuario->set_sobrenome(isset($_POST['sobrenome']) ? $_POST['sobrenome'] : null);
                            $usuario->set_fone(isset($_POST['fone']) ? $_POST['fone'] : null);
                            $usuario->set_fone_alternativo(isset($_POST['fone_alternativo']) ? $_POST['fone_alternativo'] : null);
                            $usuario->set_email(isset($_POST['email']) ? $_POST['email'] : null);
                            $usuario->set_email_alternativo(isset($_POST['email_alternativo']) ? $_POST['email_alternativo'] : null);
                            
                            $usuario->SalvarDados();
                                
                            return $response;
                        });
                    });
                    
                    $app->group('/endereco', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $endereco = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco();
                            
                            $endereco->CarregarDados();
                            
                            return $response;
                        });
                        
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $endereco = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco();
                            
                            $endereco->set_cidade(isset($_POST['cidade']) ? $_POST['cidade'] : null);
                            $endereco->set_estado(isset($_POST['estado']) ? $_POST['estado'] : null);
                            $endereco->set_numero(isset($_POST['numero']) ? $_POST['numero'] : null);
                            $endereco->set_cep(isset($_POST['cep']) ? $_POST['cep'] : null);
                            $endereco->set_bairro(isset($_POST['bairro']) ? $_POST['bairro'] : null);
                            $endereco->set_rua(isset($_POST['rua']) ? $_POST['rua'] : null);
                            $endereco->set_complemento(isset($_POST['complemento']) ? $_POST['complemento'] : null);
                            
                            $endereco->SalvarDados();
                            
                            return $response;
                        });
                        
                        $app->get('/cidades[/]', function(Request $request, Response $response, $args) use ($app) {
                            $endereco = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco();
                            
                            $endereco->set_estado(isset($_GET['estado']) ? $_GET['estado'] : null);
                            
                            $endereco->Retornar_Cidades_Por_Estado();
                            
                            return $response;
                        });
                    });
                    
                    $app->group('/entidade', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $entidade = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade();
                            
                            $entidade->CarregarDados();
                            
                            return $response;
                        });
                        
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $entidade = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade();
                            
                            $entidade->set_site(isset($_POST['site']) ? $_POST['site'] : null);
                            $entidade->set_nome_comercial(isset($_POST['nome_comercial']) ? $_POST['nome_comercial'] : null);
                            
                            $entidade->SalvarDados();
                            
                            return $response;
                        });
                            
                        $app->post('/imagem[/]', function(Request $request, Response $response, $args) use ($app) {
                            $entidade = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade();
                            
                            $entidade->Salvar_Imagem_TMP();
                            
                            return $response;
                        });
                        
                        $app->delete('/imagem[/]', function(Request $request, Response $response, $args) use ($app) {
                            $entidade = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade();
                            
                            $entidade->Deletar_Imagem();
                            
                            return $response;
                        });
                    });
                });
                
                $app->group('/alterar-senha', function() use ($app) {
                    $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $alterar_senha = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Alterar_Senha();
                        
                        $resposta = $alterar_senha->Carregar_Pagina();
                        
                        if ($resposta === false) {
                            return $response->withRedirect('/usuario/login/');
                        } else {
                            return $response;
                        }
                    });
                    
                    $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                        $alterar_senha = new Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Alterar_Senha();
                        
                        $alterar_senha->set_senha_antiga(isset($_POST['senha_antiga']) ? $_POST['senha_antiga'] : null);
                        $alterar_senha->set_senha_nova(isset($_POST['senha_nova']) ? $_POST['senha_nova'] : null);
                        $alterar_senha->set_senha_confnova(isset($_POST['senha_confnova']) ? $_POST['senha_confnova'] : null);
                        
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
            });
        });
    });
    
    $app->group('/quem-somos', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $quem_somos = new Module\Application\Controller\Quem_Somos();
            
            $quem_somos->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/perguntas-frequentes', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $perguntas_frequentes = new Module\Application\Controller\Perguntas_Frequentes();
            
            $perguntas_frequentes->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/dicas-de-venda', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $dicas_de_venda = new Module\Application\Controller\Dicas_De_Venda();
            
            $dicas_de_venda->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/fale-conosco', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $fale_conosco = new Module\Application\Controller\Fale_Conosco();
            
            $fale_conosco->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/vendedores', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $vendedores = new Module\Application\Controller\Vendedores();
            
            $vendedores->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/orcamentos', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $orcamentos = new Module\Application\Controller\Orcamentos();
            
            $orcamentos->Carregar_Pagina();
            
            return $response;
        });
        
        $app->get('/ajax[/]', function(Request $request, Response $response, $args) use ($app) {
            $orcamentos = new Module\Application\Controller\Orcamentos();
            
            $orcamentos->set_indice(isset($_GET['indice']) ? $_GET['indice'] : null);
            
            $orcamentos->Carregar_Orcamentos();
            
            return $response;
        });
    });
    
    $app->group('/termos-de-uso', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $termos_de_uso = new Module\Application\Controller\Termos_De_Uso();
            
            $termos_de_uso->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/mapa-do-site', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $mapa_do_site = new Module\Application\Controller\Mapa_Do_Site();
            
            $mapa_do_site->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/politica-de-privacidade', function() use ($app) {
        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
            $politica_de_privacidade = new Module\Application\Controller\Politica_De_Privacidade();
            
            $politica_de_privacidade->Carregar_Pagina();
            
            return $response;
        });
    });
    
    $app->group('/pecas', function() use ($app) {
        $app->group('/resultados', function() use ($app) {
            $app->group('/em', function() use ($app) {
                $app->get('[/{estado}/{cidade}[/[{categoria}[/[{marca}[/[{modelo}[/[{versao}[/]]]]]]]]]]', function(Request $request, Response $response, $args) use ($app) {
                    $resultados = new Module\Application\Controller\Pecas\Resultados();
                    
                    if (isset($args['estado'])) {
                        $resultados->set_estado_uf($args['estado']);
                    }
                    
                    if (isset($args['cidade'])) {
                        $resultados->set_cidade_url($args['cidade']);
                    }
                    
                    if (isset($args['categoria'])) {
                        $resultados->set_categoria_url($args['categoria']);
                    }
                    
                    if (isset($args['marca'])) {
                        $resultados->set_marca_url($args['marca']);
                    }
                    
                    if (isset($args['modelo'])) {
                        $resultados->set_modelo_url($args['modelo']);
                    }
                    
                    if (isset($args['versao'])) {
                        $resultados->set_versao_url($args['versao']);
                    }
                    
                    if (isset($_GET['ano_de'])) {
                        $resultados->set_ano_de($_GET['ano_de']);
                    }
                    
                    if (isset($_GET['ano_ate'])) {
                        $resultados->set_ano_ate($_GET['ano_ate']);
                    }
                    
                    if (isset($_GET['peca'])) {
                        $resultados->set_peca_nome($_GET['peca']);
                    }
                    
                    if (isset($_GET['pagina'])) {
                        $resultados->set_pagina($_GET['pagina']);
                    }
                    
                    if (isset($_GET['ordem_preco'])) {
                        $resultados->set_ordem_preco($_GET['ordem_preco']);
                    }
                    
                    if (isset($_GET['ordem_data'])) {
                        $resultados->set_ordem_data($_GET['ordem_data']);
                    }
                    
                    if (isset($_GET['estado_uso'])) {
                        $resultados->set_estado_uso_url($_GET['estado_uso']);
                    }
                    
                    if (isset($_GET['preferencia_entrega'])) {
                        $resultados->set_preferencia_entrega_url($_GET['preferencia_entrega']);
                    }
                    
                    if (isset($_GET['status_peca'])) {
                        $resultados->set_status_peca_url($_GET['status_peca']);
                    }
                    
                    $resultados->Carregar_Pagina();
                    
                    return $response;
                });
            });
            
            $app->group('', function() use ($app) {
                $app->get('[/[{categoria}[/[{marca}[/[{modelo}[/[{versao}[/]]]]]]]]]', function(Request $request, Response $response, $args) use ($app) {
                    $resultados = new Module\Application\Controller\Pecas\Resultados();
                    
                    if (isset($args['categoria'])) {
                        $resultados->set_categoria_url($args['categoria']);
                    }
                    
                    if (isset($args['marca'])) {
                        $resultados->set_marca_url($args['marca']);
                    }
                    
                    if (isset($args['modelo'])) {
                        $resultados->set_modelo_url($args['modelo']);
                    }
                    
                    if (isset($args['versao'])) {
                        $resultados->set_versao_url($args['versao']);
                    }
                    
                    if (isset($_GET['ano_de'])) {
                        $resultados->set_ano_de($_GET['ano_de']);
                    }
                    
                    if (isset($_GET['ano_ate'])) {
                        $resultados->set_ano_ate($_GET['ano_ate']);
                    }
                    
                    if (isset($_GET['peca'])) {
                        $resultados->set_peca_nome($_GET['peca']);
                    }
                    
                    if (isset($_GET['pagina'])) {
                        $resultados->set_pagina($_GET['pagina']);
                    }
                    
                    if (isset($_GET['ordem_preco'])) {
                        $resultados->set_ordem_preco($_GET['ordem_preco']);
                    }
                    
                    if (isset($_GET['ordem_data'])) {
                        $resultados->set_ordem_data($_GET['ordem_data']);
                    }
                    
                    if (isset($_GET['estado_uso'])) {
                        $resultados->set_estado_uso_url($_GET['estado_uso']);
                    }
                    
                    if (isset($_GET['preferencia_entrega'])) {
                        $resultados->set_preferencia_entrega_url($_GET['preferencia_entrega']);
                    }
                    
                    if (isset($_GET['status_peca'])) {
                        $resultados->set_status_peca_url($_GET['status_peca']);
                    }
                    
                    $resultados->Carregar_Pagina();
                    
                    return $response;
                });
            });
        });
        
        $app->group('/detalhes/{peca}', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $detalhes = new Module\Application\Controller\Pecas\Detalhes();
                
                if (isset($args['peca'])) {
                    $detalhes->set_peca_url($args['peca']);
                }
                
                $retorno = $detalhes->Carregar_Pagina();
                
                if ($retorno === 'erro') {
                    return $response->withStatus(404);
                } else {
                    return $response;
                }
            });
        });
    });
    
    $app->group('/admin', function() use ($app) {
        $app->group('/login', function() use ($app) {
            $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Administration\Controller\Admin\Login();
            
                $login->Carregar_Pagina();
            
                return $response;
            });
            
            $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Administration\Controller\Admin\Login();
                
                $login->set_usuario(isset($_POST['usuario']) ? $_POST['usuario'] : null);
                $login->set_senha(isset($_POST['senha']) ? $_POST['senha'] : null);
                
                $resposta = $login->Login();
                
                if ($resposta) {
                    return $response->withRedirect('/admin/controle/base-de-conhecimento/cmmv/');
                } else {
                    return $response;
                }
            });
            
            $app->get('/sair[/]', function(Request $request, Response $response, $args) use ($app) {
                $login = new Module\Administration\Controller\Admin\Login();
                
                if (isset($_GET['logout'])) {
                    $login->set_logout($_GET['logout']);
                }
                
                $login->LogOut();
                
                return $response->withRedirect('/admin/login/');
            });
        });
        
        $app->group('/controle', function() use ($app) {
            $app->group('/base-de-conhecimento', function() use ($app) {
                $app->group('/cmmv', function() use ($app) {
                    $app->group('', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $gerenciar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar();
                            
                            $resposta = $gerenciar->Carregar_Pagina();
                            
                            if ($resposta === false) {
                                return $response->withRedirect('/admin/login/');
                            } else {
                                return $response;
                            }
                        });
                    });
                    
                    $app->group('/cadastrar', function() use ($app) {
                        $app->get('/categorias[/]', function(Request $request, Response $response, $args) use ($app) {
                            $cadastrar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar();
                            
                            $cadastrar->Retornar_Categorias();
                            
                            return $response;
                        });
                        
                        $app->get('/marcas[/]', function(Request $request, Response $response, $args) use ($app) {
                            $cadastrar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar();
                            
                            if (isset($_GET['categoria'])) {
                                $cadastrar->set_categoria($_GET['categoria']);
                            }
                            
                            $cadastrar->Retornar_Marcas_Por_Categoria();
                            
                            return $response;
                        });
                        
                        $app->get('/modelos[/]', function(Request $request, Response $response, $args) use ($app) {
                            $cadastrar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar();
                            
                            if (isset($_GET['marca'])) {
                                $cadastrar->set_marca($_GET['marca']);
                            }
                            
                            $cadastrar->Retornar_Modelos_Por_Marca();
                            
                            return $response;
                        });
                        
                        $app->get('/versoes[/]', function(Request $request, Response $response, $args) use ($app) {
                            $cadastrar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar();
                            
                            if (isset($_GET['modelo'])) {
                                $cadastrar->set_modelo($_GET['modelo']);
                            }
                            
                            $cadastrar->Retornar_Versoes_Por_Modelo();
                            
                            return $response;
                        });
                        
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $cadastrar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar();
                            
                            if (isset($_POST['categoria'])) {
                                $cadastrar->set_categoria($_POST['categoria']);
                            }
                            
                            if (isset($_POST['marca'])) {
                                $cadastrar->set_marca($_POST['marca']);
                            }
                            
                            if (isset($_POST['modelo'])) {
                                $cadastrar->set_modelo($_POST['modelo']);
                            }
                            
                            if (isset($_POST['versao'])) {
                                $cadastrar->set_versao($_POST['versao']);
                            }
                            
                            if (isset($_POST['nome'])) {
                                $cadastrar->set_nome($_POST['nome']);
                            }
                            
                            if (isset($_POST['url'])) {
                                $cadastrar->set_url($_POST['url']);
                            }
                            
                            $cadastrar->Cadastrar_CMMV();
                            
                            return $response;
                        });
                    });
                    
                    $app->group('/alterar', function() use ($app) {
                        $app->get('/categorias[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            $alterar->Retornar_Categorias();
                            
                            return $response;
                        });
                        
                        $app->get('/marcas[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['categoria'])) {
                                $alterar->set_categoria($_GET['categoria']);
                            }
                            
                            $alterar->Retornar_Marcas_Por_Categoria();
                            
                            return $response;
                        });
                        
                        $app->get('/modelos[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['marca'])) {
                                $alterar->set_marca($_GET['marca']);
                            }
                            
                            $alterar->Retornar_Modelos_Por_Marca();
                            
                            return $response;
                        });
                        
                        $app->get('/versoes[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['modelo'])) {
                                $alterar->set_modelo($_GET['modelo']);
                            }
                            
                            $alterar->Retornar_Versoes_Por_Modelo();
                            
                            return $response;
                        });
                        
                        $app->get('/categoria[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['categoria'])) {
                                $alterar->set_categoria($_GET['categoria']);
                            }
                            
                            $alterar->Retornar_Categoria();
                            
                            return $response;
                        });
                        
                        $app->get('/marca[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['marca'])) {
                                $alterar->set_marca($_GET['marca']);
                            }
                            
                            $alterar->Retornar_Marca();
                            
                            return $response;
                        });
                        
                        $app->get('/modelo[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['modelo'])) {
                                $alterar->set_modelo($_GET['modelo']);
                            }
                            
                            $alterar->Retornar_Modelo();
                            
                            return $response;
                        });
                        
                        $app->get('/versao[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_GET['versao'])) {
                                $alterar->set_versao($_GET['versao']);
                            }
                            
                            $alterar->Retornar_Versao();
                            
                            return $response;
                        });
                        
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $alterar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar();
                            
                            if (isset($_POST['categoria'])) {
                                $alterar->set_categoria($_POST['categoria']);
                            }
                            
                            if (isset($_POST['marca'])) {
                                $alterar->set_marca($_POST['marca']);
                            }
                            
                            if (isset($_POST['modelo'])) {
                                $alterar->set_modelo($_POST['modelo']);
                            }
                            
                            if (isset($_POST['versao'])) {
                                $alterar->set_versao($_POST['versao']);
                            }
                            
                            if (isset($_POST['nome'])) {
                                $alterar->set_nome($_POST['nome']);
                            }
                            
                            if (isset($_POST['url'])) {
                                $alterar->set_url($_POST['url']);
                            }
                            
                            $alterar->Alterar_CMMV();
                            
                            return $response;
                        });
                    });
                    
                    $app->group('/deletar', function() use ($app) {
                        $app->get('/categorias[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            $deletar->Retornar_Categorias();
                            
                            return $response;
                        });
                        
                        $app->get('/marcas[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['categoria'])) {
                                $deletar->set_categoria($_GET['categoria']);
                            }
                            
                            $deletar->Retornar_Marcas_Por_Categoria();
                            
                            return $response;
                        });
                            
                        $app->get('/modelos[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['marca'])) {
                                $deletar->set_marca($_GET['marca']);
                            }
                            
                            $deletar->Retornar_Modelos_Por_Marca();
                            
                            return $response;
                        });
                            
                        $app->get('/versoes[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['modelo'])) {
                                $deletar->set_modelo($_GET['modelo']);
                            }
                            
                            $deletar->Retornar_Versoes_Por_Modelo();
                            
                            return $response;
                        });
                            
                        $app->get('/categoria[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['categoria'])) {
                                $deletar->set_categoria($_GET['categoria']);
                            }
                            
                            $deletar->Retornar_Categoria();
                            
                            return $response;
                        });
                            
                        $app->get('/marca[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['marca'])) {
                                $deletar->set_marca($_GET['marca']);
                            }
                            
                            $deletar->Retornar_Marca();
                            
                            return $response;
                        });
                            
                        $app->get('/modelo[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['modelo'])) {
                                $deletar->set_modelo($_GET['modelo']);
                            }
                            
                            $deletar->Retornar_Modelo();
                            
                            return $response;
                        });
                            
                        $app->get('/versao[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_GET['versao'])) {
                                $deletar->set_versao($_GET['versao']);
                            }
                            
                            $deletar->Retornar_Versao();
                            
                            return $response;
                        });
                            
                        $app->post('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $deletar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar();
                            
                            if (isset($_POST['categoria'])) {
                                $deletar->set_categoria($_POST['categoria']);
                            }
                            
                            if (isset($_POST['marca'])) {
                                $deletar->set_marca($_POST['marca']);
                            }
                            
                            if (isset($_POST['modelo'])) {
                                $deletar->set_modelo($_POST['modelo']);
                            }
                            
                            if (isset($_POST['versao'])) {
                                $deletar->set_versao($_POST['versao']);
                            }
                            
                            if (isset($_POST['nome'])) {
                                $deletar->set_nome($_POST['nome']);
                            }
                            
                            if (isset($_POST['url'])) {
                                $deletar->set_url($_POST['url']);
                            }
                            
                            $deletar->Deletar_CMMV();
                            
                            return $response;
                        });
                    });
                });
                
                $app->group('/compatibilidade', function() use ($app) {
                    $app->group('', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            $gerenciar = new Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar();
                            
                            $resposta = $gerenciar->Carregar_Pagina();
                            
                            if ($resposta === false) {
                                return $response->withRedirect('/admin/login/');
                            } else {
                                return $response;
                            }
                        });
                    });
                    
                    $app->group('/cadastrar', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            
                            return $response;
                        });
                    });
                    
                    $app->group('/alterar', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            
                            return $response;
                        });
                    });
                    
                    $app->group('/deletar', function() use ($app) {
                        $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                            
                            return $response;
                        });
                    });
                });
            });
            
            $app->group('/usuario/alterar-senha', function() use ($app) {
                $app->get('[/]', function(Request $request, Response $response, $args) use ($app) {
                    
                    return $response;
                });
            });
        });
    });
    
    $app->run();
