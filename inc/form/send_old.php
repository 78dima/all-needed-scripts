<?php
	/*$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$message = htmlspecialchars($_POST["message"]);*/

	$response = "error";
	if ( isset($_POST) && !empty($_POST)) {

		foreach ($_POST as $post_key => $post_val) {
			$$post_key = htmlspecialchars($post_val);
		}
		if ($name && $tel) {
			$url = $_SERVER['HTTP_HOST'];
			$HTTP_HOST = parse_url ("http://".$_SERVER["HTTP_HOST"]); 
			$HTTP_HOST = str_replace (array ("http://","www."), "", $HTTP_HOST["host"]);
			$from = "noreply@".$HTTP_HOST;
			 
			$emailTo = "info@stroy-power.ru, svt.antonova@cdbs.ru, rbooster@yandex.ru";
			$subject = 'Сообщение с сайта "'.$url.'"';
			
			if ($name) {
				// prepare email body text
				$body .= "Имя: ";
				$body .= $name;
				$body .= "<br>\n";
			}
			
			if ($email) { 
				$body .= "Почта: ";
				$body .= $email;
				$body .= "<br>\n";
			}

			if ($tel) { 
				$body .= "Телефон: ";
				$body .= $tel;
				$body .= "<br>\n";
			}

			if ($area) { 
				$body .= "Площадь объекта: ";
				$body .= $area;
				$body .= "<br>\n";
			}

			if ($company) { 
				$body .= "Компания: ";
				$body .= $company;
				$body .= "<br>\n";
			}

			if ($city) { 
				$body .= "Город: ";
				$body .= $city;
				$body .= "<br>\n";
			}

			$headers = "Content-type: text/html; charset=UTF-8" . "\r\n"; //text/html; 
			$headers .= "From: $url <".$from.">" . "\r\n";

			/*if( isset($_FILES['file']) ) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
				$filename = $_FILES['file']['name'];
				$filetype = $_FILES['file']['type'];

				$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"\n";
				$body .= "Content-Transfer-Encoding:base64\n";
				$body .= "Content-Disposition: attachment; filename=\"".$filename."\"\n\n";
				$body .= $attachment."\n";

				$success = mail('a.anikeev@wbooster.ru', $subject, $body, $headers);
			} else {*/
				$success = mail($emailTo, $subject, $body, $headers);
			//} 
			// send email
			//$success = mail($emailTo, $subject, $body, $headers);
			 
			// redirect to success page
			if ($success) {
				//file_get_contents('http://crm.wbooster.ru/index.php?controller=newlead&host='.urlencode($HTTP_HOST).'&name='.urlencode($name).'&phone='.urlencode($tel);
			   	$response = "success";
			}
		}
	}
	echo $response;
	die();
?>