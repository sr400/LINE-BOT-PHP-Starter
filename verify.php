<?php
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:kAGPyNjh3AUgNlN';

$access_token = 'emV5nMwQsdwmI44zJj/C+/6hXYu3Sy4TIoVyJJlEwExeogcHR9eKXR+S4c6ANoggl6dcpPSRS0muFOYb0HeYsMT/nKDEick+nSlkiq5q+fu1LvU97RpZ3qUHkdXbxq0JCVVWcqQ22k3zFgBFPdaGwgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

//PROXY
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

$result = curl_exec($ch);
curl_close($ch);

echo $result;
