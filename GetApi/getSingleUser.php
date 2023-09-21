<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../dbConnection.php');
require_once('../users.php');


//instantiate User class
$users = new Users($dbcon);

$users->name = isset($_GET['name']) ? $_GET['name'] : die() ;
// $users->name = json_decode(file_get_contents("php://input"),true);

echo $users->name;

if($_SERVER['REQUEST_METHOD']=='GET'){

    //get users
        $users->read_single();

        $user_arr = array(
            'name' => $users->name,
            'age' => $users->age,
            'gender' => $users->gender,
            'roll' => $users->roll
        );

    //make a json
        print_r(json_encode($user_arr));

}
else{
   echo json_encode(array('message'=>'Invalid Request Method.'));
}



?> 