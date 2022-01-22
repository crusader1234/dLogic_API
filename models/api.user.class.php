<?php
include_once 'dbh.class.php';

class API_USER extends Dbh{





      //diactivate api key if expire date is due
      public function diactivateApiKey($api_key)
      {
        try
        {
  
          $sql = "UPDATE api_keys SET `status` = 0 WHERE api_key = ?";
          $stmt = $this->connection()->prepare($sql);
          $stmt->execute([$api_key]);

  
        }catch(Exception $e)
        {

          throw new Exception($e->getMessage());   
        }	         
      }



      //validate user id
      public function validateUserId($user_id)
      {
        try
        {
  
          $sql = "SELECT * from api_users where `user_id` = ?";
          $stmt = $this->connection()->prepare($sql);
          $stmt->execute([$user_id]);
          $count = $stmt->rowCount();

          if($count == 0){
              $result = array("row"=>0,"message"=>"invalid user id");
              return $result;
          }else{
            $result = array("row"=>1,"message"=>"result found","data"=>$stmt->fetch(PDO::FETCH_OBJ));
            return $result;

          }

  
        }catch(Exception $e)
        {

          throw new Exception($e->getMessage());   
        }	         
      }

           



}