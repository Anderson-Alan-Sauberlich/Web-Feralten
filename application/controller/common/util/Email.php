<?php
namespace application\controller\common\util;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception as Mail_Exception;
    use application\model\object\Contato_Anunciante as Object_Contato_Anunciante;
    
    class Email {
        
        function __construct() {
            
        }
        
        public static function Enviar_Email_Contato_Anunciante(Object_Contato_Anunciante $object_contato_anunciante) : bool {
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
        
    }
?>