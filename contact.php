<?php

$result = 'ok';
if(trim($_POST['name']) === '') {
  $result = 'Error - falta el campo nombre';
}else{
  $name = trim($_POST['name']);
}
if(trim($_POST['email']) === '') {
  $result = 'Error - falta el campo email';
}else{
  $email = trim($_POST['email']);
}
if(trim($_POST['comments']) === '') {
  $result = 'Error - falta el campo comentarios';
}else{
  $comments = trim($_POST['comments']);
}

if($result=='ok'){
    $emailTo = 'info@ondabravaradio.com';
    $subject = 'Desde el formulario de contactenos del Sitio Ondabravaradio.com - Submitted message from '.$name;
    $body = "Nombre: $name \n\nEmail: $email \n\nComments: $comments";
    $headers = 'From: ' .' <info@ondabravaradio.com>' . "\r\n" . 'Reply-To: ' . $email;

    mail($emailTo, $subject, $body, $headers);



}

echo $result;
