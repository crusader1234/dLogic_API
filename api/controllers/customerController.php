<?php

// include_once 'models/api.keys.class.php';
// include_once 'models/api.user.class.php';
include_once '../../models/customer.class.php';

class customerController {

    private $requestMethod;
    private $userId;

    private $customerGateway;

    public function __construct( $requestMethod, $userId)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;

        $this->customerGateway = new CUSTOMER();
    } 

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case "GET":
                if ($this->userId) {
                    $response = $this->getCustomer($this->userId);
                } else {
                    $response = $this->getAllCustomers();
                };
                break;
            case "POST":
                $response = $this->createCustomerFromRequest();
                break;
            case "PUT":
                $response = $this->updateCustomerFromRequest();
                break;
            case "DELETE":
                $response = $this->deleteUser($this->userId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllCustomers()
    {
        $result = $this->customerGateway->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('code' => 200,'message' =>"success",'data'=>$result));
        return $response;
    }

    private function getCustomer($id)
    {
        $result = $this->customerGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] =  json_encode(array('code' => 200,'message' =>"success",'data'=>$result));
        return $response;
    }

    private function createCustomerFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateCustomerData($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->customerGateway->create($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(array('code' => 201,'message' =>"success"));
        return $response;
    }

    private function updateCustomerFromRequest()
    {
        
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateCustomerData($input)) {
            return $this->unprocessableEntityResponse();
        }

        $result = $this->customerGateway->find($input["id"]);
        if (! $result) {
            return $this->notFoundResponse();
        }

        $this->customerGateway->update($input);
        $result = $this->customerGateway->find($input["id"]);


        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('code' => 200,'message' =>"success","data"=>$result));
        return $response;
    }

    private function deleteUser($id)
    {
        $result = $this->customerGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->customerGateway->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('code' => 200,'message' =>"success"));
        return $response;
    }

    private function validateCustomerData($input)
    {
        if (! isset($input['fullname'])) {
            return false;
        }
        if (! isset($input['email'])) {
            return false;
        }
        if (! isset($input['phone'])) {
            return false;
        }
        if (! isset($input['address'])) {
            return false;
        }
        if (! isset($input['dAddress'])) {
            return false;
        }
        if (! isset($input['businessType'])) {
            return false;
        }
        if (! isset($input['businessName'])) {
            return false;
        }
        if (! isset($input['createdBy'])) {
            return false;
        }
        if (! isset($input['status'])) {
            return false;
        }
        return true;
    }


    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}