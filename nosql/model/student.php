<?php

if (!empty($_POST)) {
  $response = new student();
  switch($_GET['action']) {
    case 'updateStudentDetail':
      $response->updateStudentDetail($_POST);
      break;
    case 'addStudentDetail':
      $response->addStudentDetail($_POST);
      break;
    default:
      break;
  }
}

class student {
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
  
  // Handles getting of all student
  public function getAllStudent() {
    $student = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3001/student/admin", ""));

    // To get student course name
    $courses = new Course();

    $filteredStudent = array();
    foreach ($student->respond as $students) {
      if ($students->studentactive != 1) {
        foreach($courses->getAllCourses() as $course) {
          if ($course->id == $students->studentcourse) {
            $students->studentcourse = $course->name;
            $students->studentcourseid = $course->id;
          }
        }
        array_push($filteredStudent, $students);
      }
    }
    return $filteredStudent;
  }
  
  // Handles getting students with no account
  public function getStudentWithNoAccount() {
    $studentWithNoAccount = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3001/student/studentlist/noaccount", ""));
    
    $courses = new Course();
    
    $studentArray = array();
    
    foreach($studentWithNoAccount->respond as $students) {
      foreach($courses->getAllCourses() as $course) {
        if ($course->id == $students->studentcourse) {
          $students->studentcourse = $course->name;

        }
      }
      array_push($studentArray, $students);
    }
    return $studentArray;
  }
  
  // Handles updating of student
  public function updateStudentDetail($data) {
    $data = array(
      "name"      => $data['name'],
      "matrics"   => $data['matrics'],
      "phone"     => $data['phone'],
      "dob"       => date("Y-m-d H:i:s", strtotime($data['dob'])),
      "address"   => $data['address'],
      "image"     => $data['img'],
//       "image"     => '/image/event/123123.png',
      "accountid" => $data['accountid'],
      "courseid"  => $data['courseid'],
      "active"    => $data['active']
    );

    $response = $this->getCurl("PUT", 'http://ict2103group12.tk:3001/student/admin/' . $data['matrics'], $data);
    echo $response;
  }
  
  // Handles adding of student
  public function addStudentDetail($data) {    
    $data = array(
      "name"      => $data['name'],
      "matrics"   => $data['matrics'],
      "phone"     => $data['phone'],
      "dob"       => date("Y-m-d H:i:s", strtotime($data['dob'])),
      "address"   => $data['address'],
      "image"     => $data['img'],
      "courseid"  => $data['courseid'],
      "active"    => '0'
    );
    
    $response = $this->getCurl("POST", 'http://ict2103group12.tk:3001/student/admin/', $data);
    echo $response;
  }
}
?>