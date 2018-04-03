<?php
namespace Module\Email\Controller\Common\Util;
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception as Mail_Exception;
    use Module\Application\Model\OBJ\Contato_Anunciante as OBJ_Contato_Anunciante;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\OBJ\Recuperar_Senha as OBJ_Recuperar_Senha;
    use Module\Application\Model\OBJ\Contato as OBJ_Contato;
    use Module\Application\Model\OBJ\Orcamento_Peca as OBJ_Orcamento_Peca;
    use Module\Email\View\SRC\Boas_Vindas as View_Boas_Vindas;
    use Module\Email\View\SRC\Recuperar_Senha as View_Recuperar_Senha;
    use Module\Email\View\SRC\Contato_Anunciante as View_Contato_Anunciante;
    use Module\Email\View\SRC\Orcamento_Peca as View_Orcamento_Peca;
    
    class Email
    {
        function __construct()
        {
            
        }
        
        public static function Enviar_Contato_Anunciante(OBJ_Contato_Anunciante $obj_contato_anunciante) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'anderson.alan@feralten.com';
                $mail->Password = '$NdrsN#494';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato@feralten.com', 'Contato Feralten');
                $mail->addAddress($obj_contato_anunciante->get_obj_peca()->get_responsavel()->get_email());
                $mail->addReplyTo($obj_contato_anunciante->get_email(), $obj_contato_anunciante->get_nome());
                $mail->addCC('contato@feralten.com');
                
                $view_contato_anunciante = new View_Contato_Anunciante();
                $view_contato_anunciante->set_obj_contato_anunciante($obj_contato_anunciante);
                ob_start();
                $view_contato_anunciante->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Nova mensagem de '.$obj_contato_anunciante->get_nome();
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Contato(OBJ_Contato $obj_contato) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'anderson.alan@feralten.com';
                $mail->Password = '$NdrsN#494';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato@feralten.com', 'Contato Feralten');
                $mail->addAddress('contato@feralten.com', 'Contato Feralten');
                $mail->addReplyTo($obj_contato->get_email(), $obj_contato->get_nome());
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Contato - '.$obj_contato->get_assunto().' - '.$obj_contato->get_nome();
                $mail->Body    = '<p>Nome: '.$obj_contato->get_nome().'</p>';
                $mail->Body   .= '<p>Email: '.$obj_contato->get_email().'</p>';
                $mail->Body   .= '<p>Telefone: '.$obj_contato->get_telefone().'</p>';
                $mail->Body   .= '<p>Whatsapp: '.$obj_contato->get_whatsapp().'</p>';
                $mail->Body   .= '<p>Assunto: '.$obj_contato->get_assunto().'</p>';
                $mail->Body   .= '<p>Mensagem: '.$obj_contato->get_mensagem().'</p>';
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Boas_Vindas(OBJ_Usuario $obj_usuario) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'anderson.alan@feralten.com';
                $mail->Password = '$NdrsN#494';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress($obj_usuario->get_email());
                $mail->addReplyTo('feralten@feralten.com', 'Feralten');
                $mail->addCC('contato@feralten.com');
                
                $view_boas_vindas = new View_Boas_Vindas();
                $view_boas_vindas->set_obj_usuario($obj_usuario);
                ob_start();
                $view_boas_vindas->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Seja muito bem vindo(a) '.$obj_usuario->get_nome();
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Recuperar_Senha(OBJ_Recuperar_Senha $obj_recuperar_senha) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'anderson.alan@feralten.com';
                $mail->Password = '$NdrsN#494';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('suporte@feralten.com', 'Suporte Feralten');
                $mail->addAddress($obj_recuperar_senha->get_obj_usuario()->get_email());
                $mail->addReplyTo('suporte@feralten.com', 'Suporte Feralten');
                $mail->addCC('contato@feralten.com');
                
                $view_recuperar_senha = new View_Recuperar_Senha();
                $view_recuperar_senha->set_obj_recuperar_senha($obj_recuperar_senha);
                ob_start();
                $view_recuperar_senha->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Criar Nova Senha';
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Orcamento_Peca(OBJ_Orcamento_Peca $obj_orcamento_peca) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'anderson.alan@feralten.com';
                $mail->Password = '$NdrsN#494';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato@feralten.com', 'Contato Feralten');
                $mail->addAddress($obj_orcamento_peca->get_orcamento()->get_usuario()->get_email());
                $mail->addReplyTo('contato@feralten.com', 'Contato Feralten');
                $mail->addCC('contato@feralten.com');
                
                $view_orcamento_peca = new View_Orcamento_Peca();
                $view_orcamento_peca->set_obj_orcamento_peca($obj_orcamento_peca);
                ob_start();
                $view_orcamento_peca->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Nova Peça Adicionada';
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
    }
