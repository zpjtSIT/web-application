<?php

// require 'language/api_url.php';

if (!empty($_POST)) {
  $response = new faults();
  switch($_GET['action']) {
    case 'updateFaultDetail':
      $response->updateFaultDetail($_POST);
      break;
    default:
      break;
  }
}

class faults {
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
  
  public function getAllFaults(){
    $faults = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3000/fault", ""));
    return $faults->respond;
  }
  
  public function getFaultCloud(){
    $faultCloud = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3000/faultcloud/cloud", ""));
    return $faultCloud->respond;
  }
  
  public function getFaultChart(){
    $faultChart = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3000/faultcloud/chart", ""));
    return $faultChart->respond;
  }
  
  public function updateFaultDetail($data) {
    $data = array(
      "id"    => $data['id'],
      "fixed" => $data['fixed']
    );

    $response = $this->getCurl("PUT", "http://ict2103group12.tk:3000/fault/admin/" . $data['id'], $data);
    echo $response;
  }
}
?>