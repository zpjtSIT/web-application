<?php 

// require 'language/api_url.php';

class Course {
  public function getAllCourses() {
    $url = 'http://ict2103group12.tk:3000/';
    $urllogin = $url . "course/admin" ;
    
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
    
    $courses = json_decode($server_output);
    return $courses->respond;
  }
}
?>