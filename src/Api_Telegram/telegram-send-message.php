#!/bin/bash
<?php

class Api_telegram
{
  function sendMessage($chatID, $messaggio, $token) {
    echo "sending message to " . $chatID . "\n";
  
    $url = "https://api.telegram.org/bot6267084166:AAFQb1ByP74ebPIM8coZo6xzwvY0Q9Hnx8o/sendMessage?chat_id=6267084166";
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }
}
?>