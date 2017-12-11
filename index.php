<?php
 echo "R VEN";


setTimeout(function(){
    var userId = '使用者 ID';
    var sendMsg = '要發送的文字';
    bot.push(userId,sendMsg);
    console.log('send: '+sendMsg);
},5000);

?>
