<?php   
include "phpmailer/PHPMailerAutoload.php"; 

$mail = new PHPMailer(); 
$mail->IsSMTP(); 
 
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
$mail->Port = 25; 
 
$mail->SMTPDebug = 1; 
 
$mail->From = "atendimento@grupoerp.com.br"; // Seu e-mail remetente
$mail->FromName = "ERP Engenharia"; // Seu nome
$mail->AddAddress('atendimento@grupoerp.com.br', 'ERP Engenharia'); // Destinatário
$mail->addReplyTo($_POST['email'], $_POST['nome']);
 
// Opcional: mais de um destinatário
// $mail->AddAddress('fernando@email.com'); 
 
// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 
 
$mail->CharSet = 'UTF-8'; 
$mail->Subject = "Contato ERP"; 
$mail->Body = "
<html><body>
    <p>Nome: ".$_POST['nome']."</p>
    <p>E-mail: ".$_POST['email']."</p>
    <p>Telefone: ".$_POST['telefone']."</p>
    <p>Mensagem: ".$_POST['mensagem']."</p>
</body></html>";
 
// Envia o e-mail 
$enviado = $mail->Send(); 
 
// Configure aqui a mensagem de enviado
if ($enviado) { 
    $result = array('status'=>"success", 'message'=>"Message sent.");
    echo json_encode($result);
} else { 
    $result = array('status'=>"error", 'message'=>"Mailer Error: ".$mail->ErrorInfo);//
    echo json_encode($result);
} 
 
?>