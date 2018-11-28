<?php

// require 'language/api_url.php';

if (!empty($_POST)) {
  $response = new locations();
  switch($_GET['action']) {
    case 'updateLocationDetail':
      $response->updateLocationDetail($_POST);
      break;
    case 'addLocationDetail':
      $response->addLocationDetail($_POST);
      break;
    default:
      break;
  }
}


class locations {
  public function getAllLocations() {
    $url = 'http://ict2103group12.tk:3000/';
    $urllogin = $url . "location" ;

    $token = $_COOKIE['token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urllogin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);
    $locations = json_decode($server_output);
    return $locations->respond;
  }
  
  public function addLocationDetail($data) {
   
    $url = 'http://ict2103group12.tk:3000/location/admin/';
    $data = array(
      "name"        => $data['name'],
      "address"     => $data['address'],
      "lat"         => $data['lat'],
      "long"        => $data['long'],
      "description" => $data['description'],
      "opening"     => $data['opening']
    );
    
    $token = $_COOKIE['token'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $server_output = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($server_output);
    
    echo $server_output;
  }
  
  public function updateLocationDetail($data){
    $url = 'http://ict2103group12.tk:3000/location/admin/' . $data['locid'];
    $data = array(
      "name"        => $data['name'],
      "address"     => $data['address'],
      "lat"         => $data['lat'],
      "long"        => $data['long'],
      "description" => $data['description'],
      "opening"     => $data['opening']
    );
    
    $token = $_COOKIE['token'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $server_output = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($server_output);

    echo $server_output;
  }
}

class rooms {
  public function getAllRooms(){
    $url = 'http://ict2103group12.tk:3000/';
    $urllogin = $url . "schoolroom" ;

    $token = $_COOKIE['token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urllogin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);
    $rooms = json_decode($server_output);
    return $rooms->respond;
  }
}
?>