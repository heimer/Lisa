
<?php
/*----------------
index.php 
Start page whit welcome.
The first page the visitor see.
----------*/

include_once("inc/HTMLTemplate.php"); 

$content= <<<END
<div id="container">
<h1>Welcome</h1>
<p>Duis metus nibh, iaculis sit amet leo quis, vulputate aliquet orci. Donec sodales, tellus a molestie consequat, libero dolor porttitor mi, in lacinia neque nulla in nunc. Praesent luctus lacus in lacus lobortis, quis ultricies mi consequat. Pellentesque varius elementum suscipit. Suspendisse vel rutrum leo, vel commodo arcu. Cras bibendum convallis dapibus. In ultricies porttitor vestibulum. Vestibulum tempor accumsan tincidunt.</p>
			</div>
END;

echo $header;
echo $content;
echo $footer;

?>