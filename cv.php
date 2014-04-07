<?php
/*----------------
cv.php 
Page whit CV
The page the with cv.
----------*/
include_once("inc/HTMLTemplate.php");
include_once("inc/CVList.php");

$content = '<div id="container">';

foreach($cvList as $key => $item){
	$urlKey = urlencode($key); 
	$content .= <<<END
	<div class="listItem">
		<a href="cv-item.php?p={$key}">
		<img src="{$item["image"]}" alt="" />
		<p>{$key}</p>
	</div>	
	
END;
}

$content .="</div>";

echo $header;
echo $content;
echo $footer;

?>