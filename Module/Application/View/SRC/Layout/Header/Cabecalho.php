<?php
namespace Module\Application\View\SRC\Layout\Header;
    
    use Module\Application\Controller\Layout\Header\Cabecalho as Controller_Cabecalho;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Cabecalho
    {
        function __construct()
        {
            
        }
        
        public static function VerificaCookie() : bool
        {
            if (isset($_COOKIE['f_m_l'])) {
                $login = unserialize($_COOKIE['f_m_l']);
                
                if (isset($login['usuario']) AND isset($login['token'])) {
                    if (Controller_Cabecalho::Verificar_Cookie($login)) {
                        return true;
                    } else {
                        setcookie("f_m_l", null, time()-3600, "/");
                        return false;
                    }
                } else {
                    setcookie("f_m_l", null, time()-3600, "/");
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public static function VerificaAutenticacao() : bool
        {
            if (Login_session::Verificar_Login()) {
                return true;
            } else {
                return self::VerificaCookie();
            }
        }
        
        public static function RetornarCodigoLogout() : ?string
        {
            return hash_hmac('sha1', session_id(), sha1(session_id()));
        }
        
        public static function RetornarNomeMeuFeralten() : ? string
        {
            if (!empty(Login_Session::get_entidade_nome())) {
                return Login_Session::get_entidade_nome();
            } else if (!empty(Login_Session::get_usuario_nome())) {
                return Login_Session::get_usuario_nome();
            } else {
                return null;
            }
        }
    }
