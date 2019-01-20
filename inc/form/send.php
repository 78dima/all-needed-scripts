<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
//require 'phpmailer/SMTP.php';

$response["success"] = false;



if ( isset($_POST) && !empty($_POST)) {



    foreach ($_POST as $post_key => $post_val) {
        $$post_key = htmlspecialchars($post_val);
    }

    if ( !empty($name) && ( !empty($phone) || !empty($email) ) ) {
        $url = $_SERVER['HTTP_HOST'];
        $HTTP_HOST = parse_url ("https://".$_SERVER["HTTP_HOST"]);
        $HTTP_HOST = str_replace (array("https://","www."), "", $HTTP_HOST["host"]);
        $from = 'pack@evroflexpskov.ru';//"noreply@".$HTTP_HOST;

        $mail = new PHPMailer(true);
        try {
            $mail->setFrom($from, $url);
            
             if(isset($toMail)) {
                    $mail->addAddress($toMail);
             }else{
                $mail->addAddress('d.romanenko@cdbs.ru', 'Pavel');
                //$mail->addAddress('pavel@evroflexpskov.ru', 'Pavel');
             }


            //Content
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Subject = "Сообщение с сайта {$url}";

            $body = '';

            if (!empty($name)) {
                // prepare email body text
                $body .= "Имя: ";
                $body .= $name;
                $body .= "<br>";
            }

            if (!empty($email)) {
                $body .= "Почта: ";
                $body .= $email;
                $body .= "<br>";
            }

            if (!empty($phone)) {
                $body .= "Телефон: ";
                $body .= $phone;
                $body .= "<br>";
            }

            if (!empty($product)) {
                $body .= "Продукция: ";
                $body .= $product;
                $body .= "<br>";
            }
            

            if (!empty($contentWidth)) {
                $body .= "Ширина: ";
                $body .= $contentWidth;
                $body .= "<br>";
            }

            if (!empty($contentHeight)) {
                $body .= "Высота: ";
                $body .= $contentHeight;
                $body .= "<br>";
            }

            if (!empty($contentWeight)) {
                $body .= "Толщина: ";
                $body .= $contentWeight;
                $body .= "<br>";
            }
            
            if (!empty($contentTirazh)) {
                $body .= "Тираж: ";
                $body .= $contentTirazh;
                $body .= "<br>";
            }
            
            if (!empty($contentColor)) {
                $body .= "Цвет: ";
                $body .= $contentColor;
                $body .= "<br>";
            }

            if (!empty($contentCountColor)) {
                $body .= "Количество цветов: ";
                $body .= $contentCountColor;
                $body .= "<br>";
            }

            $mail->Body = $body;

            if ( $mail->send() ) {
                $response["success"] = true;
            }
            
        } catch (Exception $e) {
            $response["success"] = false;
            $response["message"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

echo json_encode($response);
die();