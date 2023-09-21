<?php 

    // starts PHP Data Objects //

    try {
        
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $db = 'gita';//database name

        $dbcon = new PDO("mysql:host=$server; dbname=$db",$user,$password);

        $dbcon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); //setting default data fetching type/mode

    //& .. to insert..
    // /*
        //.. to insert..

        // $insertQuery = " insert into gita(name,gender,age,roll) values('Amit','M',21,2007031) " ;
        // $dbcon->query($insertQuery);
        // $dbcon->exec($insertQuery);  //also use to insert

        //..or..

        // $insertQuery = " insert into gita(name,gender,age,roll) values(:name,:gender,:age,:roll) " ;
        // $stmt = $dbcon->prepare($insertQuery);
        // $stmt->bindParam(':name',$name);
        // $stmt->bindParam(':age',$age);
        // $stmt->bindParam(':gender',$gender);
        // $stmt->bindParam(':roll',$roll); 

        // $name="ak";
        // $age=20;
        // $gender='M';
        // $roll=2007031;
        // $stmt->execute();


    // */

    //& ..to select or fetch ... using varoius methods below//
    /*
        // ..to select or fetch ... using varoius methods below//

        // $selectQuery = " select * from gita where serial=4 ";
        // $stmt = $dbcon->query($selectQuery);  //gives object PDO statement  (-> called as object operator)
        // $data = $stmt->fetch();   //return in arrray as internal index also looking weired
        // $data = $stmt->fetch(PDO::FETCH_ASSOC);   //return in arrray as (key,value) (:: known scope resolution operator)
        // $data = $stmt->fetch(PDO::FETCH_NUM);   //return in arrray as (index,value)
        // $data = $stmt->fetch(PDO::FETCH_OBJ);   //return  as class Object 


        
           //.....now using PREPARED STATEMENTS.......(to prevent from sql injection)//

        //1. named parameter
        // $name ='Amar';
        // $selectQuery = " select * from gita where name=:name ";
        // $stmt = $dbcon->prepare($selectQuery);   //prepare
        // // $stmt->bindParam(':serialNo',$serialNo); //bind with another variable
        // // $stmt->execute();
        // $stmt->execute(['name'=>$name]);   //we can also used to void bindParam
        // $data = $stmt->fetch();

        //1. positional parameter
        // $serialNo =4;
        // $name ='amar';
        // $selectQuery = " select * from gita where serial=? && name=?";
        // $stmt = $dbcon->prepare($selectQuery);   //prepare
        // // $stmt->bindParam($serialNo,$name); //ye abhi hua nhi
        // $stmt->execute([$serialNo,$name]);
        echo $stmt->rowCount();  //to get rowCount
        $data = $stmt->fetch();

        echo "<br> <pre>";
        print_r($data);
        echo "Name is->".$data['name'];

    */    

    //&.....update.....//
    // /*
        //.....update.....//
        $serial=2;
        $name='Ak mourya';

        $updateQuery = "update gita set name=:name where serial=:serial";
        $stmt = $dbcon->prepare($updateQuery);
        $stmt->execute(['name'=>$name,'serial'=>$serial]);


        //.....delete......//
        $serial=3;

        $deleteQuery = 'delete from gita where serial=:serial';
        $stmt = $dbcon->prepare($deleteQuery);
        $stmt->execute(['serial'=>$serial]);


    // */
        

        

        

    } catch (Exception $e) {
        echo 'Error: ' .$e->getMessage();
        // echo 'Error: '.$e;
    }

?>