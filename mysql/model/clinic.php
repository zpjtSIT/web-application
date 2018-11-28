<?php



if(!empty($_POST)) {
  switch($_GET['action']) {
    case 'updateClinicDetail':
      $response = new clinic();
      $response->updateClinicDetail($_POST);
      break;
    case 'addClinicDetail':
      break;
    default:
      break;
  }
//   if ($_GET['action'] == 'updateStudentDetail') {
//     $response = new student();
//     $response->updateStudentDetail($_POST);
//   }
 
}

class clinic {
  public function getAllClinic(){
    $url = 'http://ict2103group12.tk:3000/';
    $urllogin = $url . "clinic" ;

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
    $clinic = json_decode($server_output);
    return $clinic->respond;
  }
  //Handles updating of student
  public function updateClinicDetail($data){
    $url = 'http://ict2103group12.tk:3000/clinic/' . $data['id'];
    $data = array(
      "id" => $data['id'],
      "name" => $data['name'],
      "address" => $data['address'],
      "postal" => $data['postal'],
      "buildingname"=>$data['buildingname'],
      "phone" =>$data['phone'],
      "lat"=>$data['lat'],
//       'lng'=>$data['lng'],
//       'estate'=>$data['estate'],
//       'fax'=>$data['fax'],
//       'openinghours'=>$data['openinghours'],
//       'remarks' => $data['remarks']
    );
    $token = $COOKIE['token'];
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
?>