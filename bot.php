<?php
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:kAGPyNjh3AUgNlN';

$access_token = 'emV5nMwQsdwmI44zJj/C+/6hXYu3Sy4TIoVyJJlEwExeogcHR9eKXR+S4c6ANoggl6dcpPSRS0muFOYb0HeYsMT/nKDEick+nSlkiq5q+fu1LvU97RpZ3qUHkdXbxq0JCVVWcqQ22k3zFgBFPdaGwgdB04t89/1O/w1cDnyilFU=';


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			if ($text=='หมี'){
				$reply_text = 'ครับ';
			}elseif ($text=='หมี:กินอะไร'){
				$reply_text = 'กินหมูครับ';
			}elseif ($text=='หมี:น้ำล่ะ'){
				$reply_text = 'โค้ก';
			}elseif ($text=='หมี:อุณหภูมิ'){
				$reply_text = '24 องศา';								
			}else{
				$reply_text = 'นอนๆ';
			}

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $reply_text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			//PROXY
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
