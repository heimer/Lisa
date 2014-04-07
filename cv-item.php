<?php
/*---------------
cv-item.php
Shows details about chosen item
from CV array.
--------------------*/

$page = isset($_GET['p']) ? $_GET['p'] : ''; 
$page = urldecode($page);

include_once("inc/HTMLTemplate.php");
include_once("inc/CVList.php");

if($page == '' || !array_key_exists($page, $cvList)){
	header("Location: index.php");
	exit();
}

$item = $cvList[$page];

$content = <<<END
	<div id="breadcrumbs">
		<p><a href="cv.php">CV</a> &gt; {$page}</p>
	</div><!---breadcrumb--->	
	<div id="container">
		<h1>{$page}</h1>
		<img scr="{$item["image"]}" alt="" />
		<p class="col-right">{$item["desc"]}</p>
		</div>
END;

echo $header;
echo $content;
echo $footer;

?>