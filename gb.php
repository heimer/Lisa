<?php
/*------------------------------
gb.php
Displays guestbook POSTs
and handels adding of new POSTs
-------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$feedback = "";
$name = "";
$msg = "";
$tabelPOST = "POST";

if(!empty($_POST)) {

	$name = isset($_POST['name']) ? $_POST['name'] : '' ;
	$msg = isset($_POST['msg']) ? $_POST['msg'] : '' ;
	$spamTest = isset($_POST['address']) ? $_POST['address'] : '' ;

	if($spamTest != '') {
		die("I think you´re a robot. If you´re not, go back and try again");

	}

	if($name == '' || $msg == '') {
		$feedback = "<p class\"feedback-yellow\">Please fill out all fields.</p>";

	} else {
		//------------------------
		//Prevents SQL injections
		$name = utf8_encode($mysqli->real_escape_string($name)); 
		$msg = utf8_encode($mysqli->real_escape_string($msg)); 
 		
 		//-----------------------
 		//SQL query
 		$query = <<<END
 		INSERT INTO {$tabelPOST} (POSTName, POSTMessage)
 		Values ('{$name}', '{$msg}');
END;

		$mysqli->query($query) or die("Could not query database" . $mysqli->errno . ": " . $mysqli->error);//Performs query 
		$feedback = "<p class\"feedback-green\">Your POST has been added. Thanks!</p>";
	}

}

$name = htmlspecialchars($name);
$msg = htmlspecialchars($msg);

$content = <<<END
			
			<div id="container">
				{$feedback}
				<form action="gb.php" method="POST">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" value="{$name}" />
					<input type="text" id="address" name="address" />
					<label for="msg">Message:</label>
					<textarea id="msg" name="msg">{$msg}</textarea>
					<input type="submit" value="Submit" />
				</form>
			</div><!--container-->
END;

//---------------------
//SQL query
$query = <<<END
SELECT POSTName, POSTMessage, POSTTimestamp
FROM {$tabelPOST}
ORDER BY POSTTimestamp DESC;
END;

$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error); //Performs query

//Loops through results 
while($row = $res->fetch_object()) {
	$date = strtotime($row->POSTTimestamp);
	$date = date("d M H H:1", $date); //http://php.net/manual/en/function.date.php

	$POSTName = utf8_decode(htmlspecialchars($row->POSTName));
	$POSTMessage = utf8_decode(htmlspecialchars($row->POSTMessage));

	$content .= <<<END
		<div class="gb-POST">
			<p class="gb-name">Written by: {$POSTName}</p>
			<P class="gb-msg">{$POSTMessage}</p>
			<p class="gb-date">{$row->POSTTimestamp}</p>
			</div>
END;
}

$content .= "</div><!--container-->";

$res->close(); //closes results 
$mysqli->close(); //closes DB connection

echo $header;
echo $content;
echo $footer;

?>