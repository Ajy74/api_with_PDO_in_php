<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with');

require_once('../dbConnection.php');
require_once('../users.php');


//instantiate User class
$users = new Users($dbcon);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    $users->serial = $data->serial;
   
    //create post
    if($users->delete()){
        echo json_encode(
            array('message'=>'user deleted.'),
        );
    }
    else{
        echo json_encode(
            array('message'=>'user not delete.'),
        );
    }

}
else{
    echo json_encode(array('message'=>'Invalid Request Method.'));
 }

    
?> 