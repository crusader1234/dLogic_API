<?php
include_once 'dbh.class.php';

class USER extends Dbh{


    //select all customers
    public function findAll()
    {
        $sql = "SELECT * from customers";
       

        try {
            
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($results as $data){

            $output[] = [
                      "id"=>$data->id,
                      "fullname"=>$data->fullname,
                      "email"=>$data->email,
                      "phone"=>$data->phone,
                      "address"=>$data->address,
                      "dAddress"=>$data->digital_address,
                      "businessType"=> $data->business_type,
                      "businessName"=> $data->business_name,
                      "status"=> $data->status,
                      "createdBy"=> $data->created_by ];
        
        }


        return $output;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    //select single customer
    public function find($id)
    {
        $sql = "SELECT * from customers WHERE id = ?";
       

        try {
            
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $output[] = [
            "id"=>$data->id,
            "fullname"=>$data->fullname,
            "email"=>$data->email,
            "phone"=>$data->phone,
            "address"=>$data->address,
            "dAddress"=>$data->digital_address,
            "businessType"=> $data->business_type,
            "businessName"=> $data->business_name,
            "status"=> $data->status,
            "createdBy"=> $data->created_by ];




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
          $sql = "INSERT INTO `customers`(`fullname`, `email`, `phone`, `address`, `digital_address`, `business_type`, `business_name`, `status`, `created_by`)  
          values(:fullname, :email, :phone, :address, :digital_address, :business_type, :business_name, :status, :created_by)";
          $stmt = $this->connection()->prepare($sql);
          if($stmt->execute([
                        "fullname"=>$input["fullname"],
                        "email"=>$input["email"],
                        "phone"=>$input["phone"],
                        "address"=>$input["address"],
                        "digital_address"=>$input["dAddress"],
                        "business_type"=>$input["businessType"],
                        "business_name"=>$input["businessName"],
                        "status"=>$input["status"],
                        "created_by"=>$input["createdBy"]])){
            return true;

          }
         
  
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }		

      }



      //update customer
      public function update(Array $input)
     {
        $sql = "UPDATE `customers` SET `fullname` = ?,`email`= ?, `phone` = ?, `address` = ?,`digital_address` = ?,`business_type` = ?,`business_name` = ?,`status` = ?, `created_by` = ? WHERE id = ?";

        try
        {
          // insert data into database
          $stmt = $this->connection()->prepare($sql);
          $stmt->execute(array($input["fullname"],$input["email"],$input["phone"],$input["address"],$input["dAddress"],$input["businessType"],$input["businessName"],$input["status"],$input["createdBy"],$input["id"]));
         
  
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }		

      }


      //delete customer
      public function delete($id)
      {
          $sql = "DELETE from customers WHERE id = ?";
         
  
          try {
              
          $stmt = $this->connection()->prepare($sql);
          $stmt->execute([$id]);
          return $stmt->rowCount();

          } catch (\PDOException $e) {
              exit($e->getMessage());
          }
      }


     

           



}