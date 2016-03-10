<?php
function getFacebookDetails($url){
        $source_url = 'https://www.facebook.com/foodtalkindia';
	$rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($source_url);
	$json = json_decode(file_get_contents($rest_url),true);
return $json;
}
$data = getFacebookDetails("http://mycodingtricks.com/html5/html5-inline-edit-with-mysql-php-jquery-and-ajax/");

$likes  = $data[0]['like_count'];
echo $likes;
?>