<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

// require_once('url.php');

// echo $api_url;

if(!empty($_POST)) {
  $response = new event();
  switch($_GET['action']) {
    case 'updateEventDetail':
      $response->updateEventDetail($_POST);
      break;
    case 'addEventDetail':
      $response->addEventDetail($_POST);
      break;
    default:
      break;
  }
}

class event {
  // Gets all events from DB via API
  public function getAllEvent(){
    $url = 'http://ict2103group12.tk:3001/event';

    $token = $_COOKIE['token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'token: ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);
    $event = json_decode($server_output);
    return $event->respond;
  }
  
  // Update event via API using PUT
  public function updateEventDetail($data) {
    $url = 'http://ict2103group12.tk:3001/event/admin/' . $data['eventid'];
//     $url = $api_url . 'event/admin/' . $data['eventid'];
    $data = array(
      "eventname"         => $data['eventname'], 
      "eventdescription"  => $data['eventdescription'],
      "eventstarttime"    => $data['eventstarttime'],
      "eventendtime"      => $data['eventendtime'],
      "roomid"            => $data['roomid'],
      "eventcreatedby"    => $data['eventcreatedby'],
      "eventimage"        => $data['eventimage'],
      "eventurl"          => $data['eventurl'] 
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
  
  // Add Events via API using POST
  public function addEventDetail($data) {
    $url = 'http://ict2103group12.tk:3001/event/admin/';
    $data = array(
      "eventname"         => $data['eventname'],
      "eventdescription"  => $data['eventdescription'],
      "eventstarttime"    => $data['eventstarttime'],
      "eventendtime"      => $data['eventendtime'],
      "roomid"            => $data['roomid'],
      "eventcreatedby"    => $data['eventcreatedby'],
	    "eventimage"        => $data['eventimage'],
	    "eventurl"          => $data['eventurl']
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
    
    echo $server_output;
    
  }
}
?>