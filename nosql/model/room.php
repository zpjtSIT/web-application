<?php 

// require 'language/api_url.php';

if (!empty($_POST)) {
  $response = new Rooms();
  switch($_GET['action']) {
    case 'updateRoomDetail':
      $response->updateRoomDetail($_POST);
      break;
    case 'addRoomDetail':
      $response->addRoomDetail($_POST);
      break;
    default:
      break;
  }
}

class Rooms {
  private function getCurl($requestType, $url, $data) {
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
  
  // Used to get all rooms
  public function getAllRooms() {
    $rooms = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3001/schoolroom", ""));
    return $rooms->respond;
  }
  
  public function updateRoomDetail($data) {
    $data = array(
      "id"          => $data['id'],
      "name"        => $data['name'],
      "size"        => $data['size'],
      "description" => $data['description'],
      "locationid"  => $data['locationid'],
    );

    $response = $this->getCurl("PUT", 'http://ict2103group12.tk:3001/schoolroom/admin/' . $data['id'], $data);
    echo $response;
  }
  
  public function addRoomDetail($data) {    
    $data = array(
      "name"        => $data['name'],
      "size"        => $data['size'],
      "description" => $data['description'],
      "locationid"  => $data['locationid'],
    );

    $response = $this->getCurl("POST", 'http://ict2103group12.tk:3001/schoolroom/admin/', $data);
    echo $response;
  }
}
?>