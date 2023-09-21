<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../dbConnection.php');
require_once('../users.php');


//instantiate User class
$users = new Users($dbcon);

if($_SERVER['REQUEST_METHOD']=='GET'){

    //get users
        $result = $users->read();

        //get row count
        $num = $result->rowCount();

        if($num > 0){
            $user_arr = array();
            $user_arr['data'] = array();

            while($row = $result->fetch()){
                extract($row);
                $user_item = array(
                    'name' => $name,
                    'age' => $age,
                    'gender' => $gender,
                    'roll' => $roll
                );
                array_push($user_arr['data'],$user_item);
            }
            //convert to JSON and output
            echo json_encode($user_arr);
        }
        else{
            json_encode(array('message'=>'No user found.'));
        }

}
else{
   echo json_encode(array('message'=>'Invalid Request Method.'));
}



?> 