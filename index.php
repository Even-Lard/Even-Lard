<?php
$access_token ='ENorgWeG1JgAW7VqsmeYqD0rZN20Y+A++cqMWfUATyAP4gKYfqMcv5Aygg6EnHxYN2euFIkgeu2bi26KJDIKieq/Qki/yWzWZLygtpuB42wjcTweM9DnsYhaYLIcuaZkvs8vJcMPIKzm+P2GbW85wAdB04t89/1O/w1cDnyilFU=';
//define('TOKEN', '你的Channel Access Token');
 
$json_string = file_get_contents('php://input');
 
$file = fopen("C:\\Line_log.txt", "a+");
fwrite($file, $json_string."\n");
$json_obj = json_decode($json_string);
 
$event = $json_obj->{"events"}[0];
$type  = $event->{"message"}->{"type"};
$message = $event->{"message"};
$reply_token = $event->{"replyToken"};
         
$post_data = [
  "replyToken" => $reply_token,
  "messages" => [
    [
      "type" => "text",
      "text" => $message->{"text"}
    ]
  ]
];
fwrite($file, json_encode($post_data)."\n");
 
$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$access_token
    //'Authorization: Bearer '. TOKEN
));
$result = curl_exec($ch);
fwrite($file, $result."\n"); 
fclose($file);
curl_close($ch);
?>
