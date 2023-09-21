<?php 

    class Users{

        //db stuff
        private $conn;
        private $table = 'gita';

        //post properties
        public $serial;
        public $name;
        public $gender;
        public $age;
        public $roll;

        //constructor with db connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //getting data from database
        public function read(){
            //create query
            $selectQuery = 'SELECT * from '.$this->table .' ';
            
            //prepare statement
            $stmt = $this->conn->prepare($selectQuery);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //getting single data from database
        public function read_single(){
            //create query
            $selectQuery = 'SELECT * from '.$this->table .'  WHERE '.$this->table .'.name = ? LIMIT 1 ';
            
            //prepare statement
            $stmt = $this->conn->prepare($selectQuery);

            //binding param
            $stmt->bindParam(1,$this->name);
            
            //execute query
            $stmt->execute();

            $row = $stmt->fetch();
            $this->name = $row['name'];
            $this->gender= $row['gender'];
            $this->age = $row['age'];
            $this->roll = $row['roll'];
        }

        //creating or storing data to database
        public function create(){
            //create query
            $insertQuery = 'INSERT INTO '.$this->table.'(name,gender,age,roll) values(:name,:gender,:age,:roll) ';
            $stmt = $this->conn->prepare($insertQuery);

            //clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->gender = htmlspecialchars(strip_tags($this->gender));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->roll = htmlspecialchars(strip_tags($this->roll));

            //binding of parameters
            $stmt->bindParam(':name',$this->name);
            $stmt->bindParam(':age',$this->age);
            $stmt->bindParam(':gender',$this->gender);
            $stmt->bindParam(':roll',$this->roll);

            //execute the query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong

            printf("Error %s. \n",$stmt->error);
            return false;

        }

        //updating data to database
        public function update(){
            //create query
            $updateQuery = 'UPDATE '.$this->table.' SET name=:name,gender=:gender,age=:age,roll=:roll WHERE serial=:serial ';
            $stmt = $this->conn->prepare($updateQuery);

            //clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->gender = htmlspecialchars(strip_tags($this->gender));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->roll = htmlspecialchars(strip_tags($this->roll));

            //binding of parameters
            $stmt->bindParam(':serial',$this->serial);
            $stmt->bindParam(':name',$this->name);
            $stmt->bindParam(':age',$this->age);
            $stmt->bindParam(':gender',$this->gender);
            $stmt->bindParam(':roll',$this->roll);

            //execute the query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong

            printf("Error %s. \n",$stmt->error);
            return false;

        }
        public function delete(){
            //create query
            $deleteQuery = 'DELETE from '.$this->table.' WHERE serial=:serial';
            $stmt = $this->conn->prepare($deleteQuery);
            
            //clean data
            $this->serial = htmlspecialchars(strip_tags($this->serial));

            $stmt->bindParam(':serial',$this->serial);
           
            //execute the query
            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong

            printf("Error %s. \n",$stmt->error);
            return false;

        }

    }


?>