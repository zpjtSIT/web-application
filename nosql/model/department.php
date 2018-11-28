<?php

class Department {
  public function getAllDepartments() {
    $url = 'http://ict2103group12.tk:3001/';
    $urllogin = $url . "department/admin" ;
    
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
    
    $departments = json_decode($server_output);
    return $departments->respond;
   }
}

?>