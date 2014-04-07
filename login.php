<?php
/*-------------
login.php
----------------*/
include_once("inc/HTMLTemplate.php");

$content = <<<END

	<form action="login.php" method="post" id="login-form">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" value="" />
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" value="" />
		<input type="submit" value="Login" />
	</form>	 
END;

if(!empty($_POST)) {
	include_once("inc/Connstring.php");
	$table = "admin";

	$username = isset($_POST['username']) ? $_POST['username'] : '' ;
	$password = isset($_POST['password']) ? $_POST['password'] : '' ;

	if($username == '' || $password == '') {
		$feedback = "<p class=\"feedback-yellow\">Please fill out all fields.</p>";
		
	} else {
		//--------------------
		//Prevents SQL injections.
		$username = $mysqli->real_escape_string($username);
		$password = $mysqli->real_escape_string($password);

		//---------------------
		//SQL query
		$query = <<<END

		SELECT adminName, adminPassword
		FROM {$table}
		WHERE adminName = "{$username}";

END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . ": " . $mysqli->error);//Performs query 

	if($res->num_rows == 1) {
		$pswmd5 = md5($password); 
		$row = $res->fetch_object();
		if($row->adminPassword == $password) {
			die("login success");
		} else {
			$feedback = "<p class=\"feedback-red\">Password is incorrect.</p>"; 
		}
		$res->close();
	} else {
		$feedback = "<p class=\"feedback-red\">Username is incorrect.</p>";

	}

	$mysqli->Close();

}

?>