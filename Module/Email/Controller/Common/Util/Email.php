<?php
namespace Module\Email\Controller\Common\Util;
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception as Mail_Exception;
    use Module\Application\Model\Object\Contato_Anunciante as Object_Contato_Anunciante;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Model\Object\Recuperar_Senha as Object_Recuperar_Senha;
    use Module\Application\Model\Object\Contato as Object_Contato;
    use Module\Application\Model\Object\Orcamento_Peca as Object_Orcamento_Peca;
    use Module\Email\View\SRC\Boas_Vindas as View_Boas_Vindas;
    use Module\Email\View\SRC\Recuperar_Senha as View_Recuperar_Senha;
    use Module\Email\View\SRC\Contato_Anunciante as View_Contato_Anunciante;
    use Module\Email\View\SRC\Orcamento_Peca as View_Orcamento_Peca;
    
    class Email
    {
        function __construct()
        {
            
        }
        
        public static function Enviar_Contato_Anunciante(Object_Contato_Anunciante $object_contato_anunciante) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress($object_contato_anunciante->get_object_peca()->get_responsavel()->get_email());
                $mail->addReplyTo($object_contato_anunciante->get_email(), $object_contato_anunciante->get_nome());
                $mail->addCC('contato.feralten@gmail.com');
                
                $view_contato_anunciante = new View_Contato_Anunciante();
                $view_contato_anunciante->set_obj_contato_anunciante($object_contato_anunciante);
                ob_start();
                $view_contato_anunciante->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Nova mensagem de '.$object_contato_anunciante->get_nome();
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Contato(Object_Contato $object_contato) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress('contato.feralten@gmail.com', 'Feralten');
                $mail->addReplyTo($object_contato->get_email(), $object_contato->get_nome());
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Contato - '.$object_contato->get_assunto().' - '.$object_contato->get_nome();
                $mail->Body    = '<p>Nome: '.$object_contato->get_nome().'</p>';
                $mail->Body   .= '<p>Email: '.$object_contato->get_email().'</p>';
                $mail->Body   .= '<p>Telefone: '.$object_contato->get_telefone().'</p>';
                $mail->Body   .= '<p>Whatsapp: '.$object_contato->get_whatsapp().'</p>';
                $mail->Body   .= '<p>Assunto: '.$object_contato->get_assunto().'</p>';
                $mail->Body   .= '<p>Mensagem: '.$object_contato->get_mensagem().'</p>';
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Boas_Vindas(Object_Usuario $object_usuario) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress($object_usuario->get_email());
                $mail->addReplyTo('feralten@feralten.com', 'Feralten');
                $mail->addCC('contato.feralten@gmail.com');
                
                $view_boas_vindas = new View_Boas_Vindas();
                $view_boas_vindas->set_obj_usuario($object_usuario);
                ob_start();
                $view_boas_vindas->Executar();
                $body_html = ob_get_contents();
                ob_end_clean();
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Seja muito bem vindo(a) '.$object_usuario->get_nome();
                $mail->Body    = $body_html;
                $mail->AltBody = '2018 - Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
        
        public static function Enviar_Recuperar_Senha(Object_Recuperar_Senha $object_recuperar_senha) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress($object_recuperar_senha->get_object_usuario()->get_email());
                $mail->addReplyTo('feralten@feralten.com', 'Feralten');
                $mail->addCC('contato.feralten@gmail.com');
                
                $view_recuperar_senha = new View_Recuperar_Senha();
                $view_recuperar_senha->set_obj_recuperar_senha($object_recuperar_senha);
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
        
        public static function Enviar_Orcamento_Peca(Object_Orcamento_Peca $object_orcamento_peca) : bool
        {
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('feralten@feralten.com', 'Feralten');
                $mail->addAddress($object_orcamento_peca->get_orcamento()->get_usuario()->get_email());
                $mail->addReplyTo('feralten@feralten.com', 'Feralten');
                $mail->addCC('contato.feralten@gmail.com');
                
                $view_orcamento_peca = new View_Orcamento_Peca();
                $view_orcamento_peca->set_obj_orcamento_peca($object_orcamento_peca);
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
