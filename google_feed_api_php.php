<?php

//$feed_url = "http://feeds.feedburner.com/thisministrynet";
$feed_url = "http://feeds.feedburner.com/LaterBoy";
$url = "https://ajax.googleapis.com/ajax/services/feed/load?" .
       "v=1.0&q=".$feed_url."&userip=INSERT-USER-IP&num=10";

// sendRequest
// note how referer is set manually
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $feed_url);
$body = curl_exec($ch);
curl_close($ch);

// now, process the JSON string
$json = json_decode($body);
// now have some fun with the results...
$feed_posts = ($json->responseData->feed->entries);

$result_html = "";
foreach($feed_posts AS $post) {
	$tags = array();
	
	$title = $post->title;
	$link = $post->link;
	$date = $post->publishedDate;
	$text = $post->content;
	$tags = $post->categories;
	
	$result_html .= "<div>\n\t<h2>".$title."</h2>\n\t<p>".$text."</p>\n</div><br /><br />\n\n";
}

echo $result_html;

?>