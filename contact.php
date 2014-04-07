<?php
/*----------
contact.php
Shows contact form and
sends e-mail after submit.
----------*/
include_once("inc/HTMLTemplate.php");

$to = '';
$subject = ''; 
$msg = '';
$headers = '';
$content = '';

if(!empty($_POST)) {
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '' ;
	$msg = isset($_POST['msg']) ? $_POST['msg'] : '' ;

	if($name == '' || $email == '' || $msg == '') {
		$form = formHTML($name, $email, $msg);
		$content = <<<END
		
		<php<div id="container">
		<p>Please fill out all fields</p>
			{$form}
		</div><!-- container -->

END;
	} else {

		$to = "lispet13@student.hh.se";
		$subject = "Message from webpage. Sender: " . $name;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
		$headers .= "From: {$email}" . "\r\n";
		$headers .= "Replay-To: {$email}";

		mail($to, $subject, $msg, $headers);
	}

} else {

	$form = formHTML();

	$content =<<<END

		<div id="container">
			{$form}
		</div><!-- container -->
		
END;

}

echo $header;
echo $content;
echo $footer;
//----------------------
//Returns HTML for contact form
foreach($_POST as $value) { 
			if(stripos($value, 'Content-Type:') !== FALSE) { 
 				echo "There was a problem. Try again."; 
		 exit; 
 	} 
} 

function formHTML($name = "", $email = "", $msg = "") {
	$name = htmlspecialchars($name);
	$email = htmlspecialchars($email);
	$msg = htmlspecialchars($msg);

	return <<<END
					<form action="contact.php" method="post">
						<label for="name">name:</label>
						<input type="text" id="name" name="name" value="" />
						<label for="email">E-Mail:</label>
						<input type="text" id="email" name="email" value="" />
						<input type="text" id="address" name="address" />
						<label for="msg">Message:</label>
						<textarea id="msg" name="msg"></textarea>
						<input type="submit" value="Submit" />
					</form>

END;
}


	if(mail($to, $subject, $msg, $headers)) {

	$content = <<<END

	 	 <div id="container">
	 	 	<p>Your message has been sent. Thank you</p>
	 	 </div><!-- container-->

END;

	} else {
		$content = <<<END

		<div id="container">
			<p>I´m sorry, something went wrong when sending tour e-mail. Please try again</p>
			<p><a href="contact.php">Back to contact page.<a></p>
		</div><!--container-->

END;

		}


?>