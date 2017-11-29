<?php
namespace Module\Application\Controller\Common\Util;
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception as Mail_Exception;
    use Module\Application\Model\Object\Contato_Anunciante as Object_Contato_Anunciante;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Model\Object\Recuperar_Senha as Object_Recuperar_Senha;
    use Module\Application\Model\Object\Contato as Object_Contato;
    
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
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato.feralten@gmail.com', 'Feralten');
                $mail->addAddress($object_contato_anunciante->get_object_peca()->get_responsavel()->get_email());
                $mail->addReplyTo($object_contato_anunciante->get_email(), $object_contato_anunciante->get_nome());
                $mail->addCC('contato.feralten@gmail.com');
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Nova mensagem de '.$object_contato_anunciante->get_nome();
                $mail->Body    = $object_contato_anunciante->get_mensagem();
                $mail->AltBody = 'Sauber Sistemas - ©2017 Feralten. Todos os direitos reservados.';
                
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
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato.feralten@gmail.com', 'Feralten');
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
                $mail->AltBody = 'Sauber Sistemas - ©2017 Feralten. Todos os direitos reservados.';
                
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
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato.feralten@gmail.com', 'Feralten');
                $mail->addAddress($object_usuario->get_email());
                $mail->addReplyTo('contato.feralten@gmail.com', 'Feralten');
                $mail->addCC('contato.feralten@gmail.com');
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Seja muito bem vindo '.$object_usuario->get_nome();
                $mail->Body    = 'Que bom que você está com a gente!';
                $mail->AltBody = 'Sauber Sistemas - ©2017 Feralten. Todos os direitos reservados.';
                
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
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'contato.feralten@gmail.com';
                $mail->Password = 'Abar$ore%FJ#12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('contato.feralten@gmail.com', 'Feralten');
                $mail->addAddress($object_recuperar_senha->get_object_usuario()->get_email());
                $mail->addReplyTo('contato.feralten@gmail.com', 'Feralten');
                $mail->addCC('contato.feralten@gmail.com');
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Feralten - Criar Nova Senha';
                $mail->Body    = 'Abra o Link e crie uma nova senha: <a>https://www.feralten.com.br/usuario/recuperar-senha/?codigo='.hash_hmac('sha512', $object_recuperar_senha->get_codigo(), hash('sha512', $object_recuperar_senha->get_codigo())).'</a>';
                $mail->AltBody = 'Sauber Sistemas - ©2017 Feralten. Todos os direitos reservados.';
                
                return $mail->send();
            } catch (Mail_Exception $e) {
                return false;
            }
        }
    }
