<?php

if (!empty($_POST)) {
  $response = new adminAccount();
  switch($_GET['action']) {
    case 'createAdminProfile':
      $response->createAdminProfile($_POST);
      break;
    case 'updateAdminProfile':
      $response->updateAdminProfile($_POST);
      break;
    case 'createAdminAccount':
      $response->createAdminAccount($_POST);
    default:
      break;
  }
}

class adminAccount {
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
  
  
    public function getAllAdminProfile() {
    $admin = json_decode($this->getCurl("GET", "http://ict2103group12.tk:3000/admin/admin", ""));

    // To get department name
    $departments = new Department();

    $filteredAdmin = array();
    foreach ($admin->respond as $admins) {
      if ($admins->adminactive != 1) {
        foreach($departments->getAllDepartments() as $department) {
          if ($department->id == $admins->admindepartment) {
            $admins->admindepartment = $department->name;
            $admins->admindepartmentid = $department->id;
          }
        }
        array_push($filteredAdmin, $admins);
      }
    }
    return $filteredAdmin;
  }
  
  
  public function createAdminProfile($data) {    
    $data = array(
      "name"          => $data['name'],
      "matrics"       => $data['matrics'],
      "phone"         => $data['phone'],
      "dob"           => date("Y-m-d H:i:s", strtotime($data['dob'])),
      "address"       => $data['address'],
      "departmentid"  => $data['departmentid'],
      "image"         => $data['image'],
      "active"        => '0'
    );
    
    $response = $this->getCurl("POST", 'http://ict2103group12.tk:3000/admin/admin/', $data);
    echo $response;
  }
  
  
  public function updateAdminProfile($data) {
    $data = array(
      "name"      => $data['name'],
      "matrics"   => $data['matrics'],
      "phone"     => $data['phone'],
      "dob"       => date("Y-m-d H:i:s", strtotime($data['dob'])),
      "address"   => $data['address'],
      "image"     => $data['img'],
      "accountid" => $data['accountid'],
      "departmentid"  => $data['departmentid'],
      "active"    => $data['active']
    );

    $response = $this->getCurl("PUT", 'http://ict2103group12.tk:3000/admin/admin/' . $data['matrics'], $data);
    echo $response;
  }
  
  public function createAdminAccount($data) {
    $data = array(
      "id"       => $data['id'],
      "username" => $data['username'],
      "password" => $data['password']
    );

    $response = $this->getCurl("POST", "http://ict2103group12.tk:3000/login/admin/admin/" . $data['id'], $data);
    echo $response;
  }

}

?>