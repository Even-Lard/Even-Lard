<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = '<ENorgWeG1JgAW7VqsmeYqD0rZN20Y+A++cqMWfUATyAP4gKYfqMcv5Aygg6EnHxYN2euFIkgeu2bi26KJDIKieq/Qki/yWzWZLygtpuB42wjcTweM9DnsYhaYLIcuaZkvs8vJcMPIKzm+P2GbW85wAdB04t89/1O/w1cDnyilFU=>';
$channelSecret = '<026443ada574ef6fb4677cde38adfb81>';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $message['text']
                            )
                        )
                    ));
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
?>
