<?php
include_once 'dbh.class.php';

class STAFF extends Dbh{


    //select all customers
    public function findAll()
    {
        $sql = "SELECT * from staffs";
       

        try {
            
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($results as $data){

            $output[] = [
                "id"=>$data->id,
                "firstname"=>$data->firstname,
                "lastname"=>$data->lastname,
                "email"=>$data->email,
                "phone"=>$data->phone,
                "department"=>$data->department,
                "position"=>$data->position,
                "dob"=>$data->dob,
                "address"=>$data->address,
                "dAddress"=>$data->digitalAddress,
                "joinedDate"=>$data->joinedDate,
                "photo"=>$data->photo
            ];
        
        }


        return $output;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    //select single customer
    public function find($id)
    {
        $sql = "SELECT * from staffs WHERE id = ?";
       

        try {
            
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $output[] = [
            "id"=>$data->id,
            "firstname"=>$data->firstname,
            "lastname"=>$data->lastname,
            "email"=>$data->email,
            "phone"=>$data->phone,
            "department"=>$data->department,
            "position"=>$data->position,
            "dob"=>$data->dob,
            "address"=>$data->address,
            "dAddress"=>$data->digitalAddress,
            "joinedDate"=>$data->joinedDate,
            "photo"=>$data->photo
         ];

        return $output;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


     // add new customer
     public function create(Array $input)
     {
        try
        {
          // insert data into database
          $sql = "INSERT INTO `staffs`
          (`firstname`, `lastname`, `email`, `phone`, `department`, `position`, `dob`, `address`, `digitalAddress`, `joinedDate`, `photo`)  
          values(:firstname,:lastname, :email, :phone,:department,:position,:dob, :address, :digitalAddress, :joinedDate, :photo)";
          $stmt = $this->connection()->prepare($sql);
          if($stmt->execute([
                        "firstname"=>$input["firstname"],
                        "lastname"=>$input["lastname"],
                        "email"=>$input["email"],
                        "phone"=>$input["phone"],
                        "department"=>$input["department"],
                        "position"=>$input["position"],
                        "dob"=>$input["dob"],
                        "address"=>$input["address"],
                        "digitalAddress"=>$input["dAddress"],
                        "joinedDate"=>$input["joinedDate"],
                        "photo"=>$input["photo"]
                        ])){
            return true;

          }
         
  
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }		

      }



      //update customer
      public function update(Array $input)
     {
        $sql = "UPDATE `staffs` SET
         `firstname` = :firstname,
         `lastname` = :lastname,
         `email`= :email, 
         `phone` = :phone, 
         `department` = :department,
         `position` = :position,
         `dob` = :dob,
         `address` = :address,
         `digitalAddress` = :digitalAddress, 
         `joinedDate` = :joinedDate,
         `photo` = :photo
          WHERE id = :id";

        try
        {
          // insert data into database
          $stmt = $this->connection()->prepare($sql);
          if($stmt->execute([
                        "firstname"=>$input["firstname"],
                        "lastname"=>$input["lastname"],
                        "email"=>$input["email"],
                        "phone"=>$input["phone"],
                        "department"=>$input["department"],
                        "position"=>$input["position"],
                        "dob"=>$input["dob"],
                        "address"=>$input["address"],
                        "digitalAddress"=>$input["dAddress"],
                        "joinedDate"=>$input["joinedDate"],
                        "photo"=>$input["photo"],
                        "id"=>(int)$input["id"]
                        ])){
            return true;

          }
         
  
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }		

      }


      //delete customer
      public function delete($id)
      {
          $sql = "DELETE from staffs WHERE id = ?";
         
  
          try {
              
          $stmt = $this->connection()->prepare($sql);
          $stmt->execute([$id]);
          return $stmt->rowCount();

          } catch (\PDOException $e) {
              exit($e->getMessage());
          }
      }


     

           



}