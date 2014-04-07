<link rel="stylesheet" type="text/css" href="exampel.css"/>
<?php
/*------------------
HTMLTemplate.php
contains HTML code that is
the same over several pages.
-------------------*/
$header = <<<END
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		
		</head>
	<body>
		<header>
			<ul id="menu">
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="cv.php"><CV>CV</a></li>
				<li><a href="gb.php"><Guestbook>Guestbook</a></li>
				<li><a href="#"><Game>Game</a></li>
				<li><a href="contact.php"><Contact>Contact</a></li>
				<li><a href="login.php"><Admin>Admin</a></li>

			</ul>	
		</header><!----header----->
		
		<div id="content">	

END;
		$footer = <<<END

		</div><!---content---->

	</body>	

</html>

END;

?>
