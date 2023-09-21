<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with');

require_once('../dbConnection.php');
require_once('../users.php');


//instantiate User class
$users = new Users($dbcon);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD']=='PUT'){

    $users->serial = $data->serial;
    $users->name = $data->name;
    $users->gender = $data->gender;
    $users->age = $data->age;
    $users->roll = $data->roll;

    //create post
    if($users->update()){
        echo json_encode(
            array('message'=>'user updated.'),
        );
    }
    else{
        echo json_encode(
            array('message'=>'user not update.'),
        );
    }

}
else{
    echo json_encode(array('message'=>'Invalid Request Method.'));
 }

    
?> 