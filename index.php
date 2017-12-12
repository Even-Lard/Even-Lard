<?php
/* アカウント情報 */
$channel_id = "[1550905925]";
$channel_secret = "[026443ada574ef6fb4677cde38adfb81]";
$mid = "[Ua535935262d7d44484cbb40b6417eae2]";

/* 送られてきたメッセージの情報を取得 */
$receive = json_decode(file_get_contents("php://input"));
$text = $receive->result{0}->content->text;
$from = $receive->result[0]->content->from;
$content_type = $receive->result[0]->content->contentType;

/* 返信 */
$header = ["Content-Type: application/json; charser=UTF-8", "X-Line-ChannelID:" . $channel_id, "X-Line-ChannelSecret:" . $channel_secret, "X-Line-Trusted-User-With-ACL:" . $mid];
$message = getContentType($content_type);
sendMessage($header, $from, $message);

/* メッセージを送る */
function sendMessage($header, $to, $message) {

$url = "https://trialbot-api.line.me/v1/events";
$data = ["to" => [$to], "toChannel" => 1383378250, "eventType" => "138311608800106203", "content" => ["contentType" => 1, "toType" => 1, "text" => $message]];
$context = stream_context_create(array(
"http" => array("method" => "POST", "header" => implode(PHP_EOL, $header), "content" => json_encode($data), "ignore_errors" => true)
));
file_get_contents($url, false, $context);
}

/* コンテントタイプの種類分け */
function getContentType($value) {

$content_type = "";
switch($value) {

case 1 :
$content_type = "這是一串文字嗎";
break;
case 2 :
$content_type = "這是一張圖片嗎";
break;
case 3 :
$content_type = "這是一個影片嗎";
break;
case 4 :
$content_type = "這是一個影片嗎";
break;
case 7 :
$content_type = "這是一個位置嗎";
break;
case 8 :
$content_type = "這是一張貼圖嗎";
break;
case 10 :
$content_type = "這是撒小東西";
break;
default:
$content_type = "挖看不懂";
break;
}

return $content_type;
}

?>
