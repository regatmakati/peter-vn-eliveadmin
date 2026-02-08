<?php
function sendDataToChatServer($sendData, $isJsonEncode = true)
{
    if ($isJsonEncode) $sendData = json_encode($sendData);
    if ($ws = websocketOpen(config('database.chatUrl'), config('database.chatPort'))) {
        websocketWrite($ws, $sendData);
    }
}
