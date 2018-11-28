<?php
$url = 'http://ict2103group12.tk:3001/';
$urllogin = $url . "login/check" ;

if(!isset($_COOKIE['token'])) {
   header('Location: index.php');
} else {

    $token = $_COOKIE['token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urllogin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);

    $token_result = json_decode($server_output);
    
    if (!$token_result->respond) {
      header('Location: index.php');
    }
    
}
?>