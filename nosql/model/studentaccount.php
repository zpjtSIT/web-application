<?php

// require 'language/api_url.php';

if (!empty($_POST)) {
  $response = new account();
  switch($_GET['action']) {
    case 'createStudentAccount':
      $response->createStudentAccount($_POST);
      break;
    default:
      break;
  }
}

class account {
  public function getCurl($requestType, $url, $data){
    $token = $_COOKIE['token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if (strtolower($requestType) != "get") {
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    $server_output = curl_exec($ch);

    curl_close($ch);
    return $server_output;
  }
  
  public function createStudentAccount($data) {
    $data = array(
      "id"       => $data['id'],
      "username" => $data['username'],
      "password" => $data['password']
    );

    $response = $this->getCurl("POST", "http://ict2103group12.tk:3001/login/admin/student/" . $data['id'], $data);
    echo $response;
  }
}

?>