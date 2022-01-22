<?php

// include_once 'models/api.keys.class.php';
// include_once 'models/api.user.class.php';
include_once '../../models/staff.class.php';

class staffController {

    private $requestMethod;
    private $staffId;

    private $staffGateway;

    public function __construct( $requestMethod, $staffId)
    {
        $this->requestMethod = $requestMethod;
        $this->staffId = $staffId;

        $this->staffGateway = new STAFF();
    } 

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->staffId) {
                    $response = $this->getStaff($this->staffId);
                } else {
                    $response = $this->getAllStaffs();
                };
                break;
            case 'POST':
                $response = $this->createStaffFromRequest();
                break;
            case 'PUT':
                $response = $this->updateStaffFromRequest();
                break;
            case 'DELETE':
                $response = $this->deleteStaff($this->staffId);
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

    private function getAllStaffs()
    {
        $result = $this->staffGateway->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getStaff($id)
    {
        $result = $this->staffGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createStaffFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->staffGateway->create($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = "success";
        return $response;
    }

    private function updateStaffFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $result = $this->staffGateway->find($input["id"]);
        if (! $result) {
            return $this->notFoundResponse();
        }
        
        
        $this->staffGateway->update($input);
        $result = $this->staffGateway->find($input["id"]);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function deleteStaff($id)
    {
        $result = $this->staffGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->staffGateway->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function validatePerson($input)
    {
        if (! isset($input['firstname'])) {
            return false;
        }
        if (! isset($input['lastname'])) {
            return false;
        }
        if (! isset($input['email'])) {
            return false;
        }
        if (! isset($input['phone'])) {
            return false;
        }
        if (! isset($input['department'])) {
            return false;
        }
        if (! isset($input['position'])) {
            return false;
        }
        if (! isset($input['dob'])) {
            return false;
        }
        if (! isset($input['address'])) {
            return false;
        }
        if (! isset($input['dAddress'])) {
            return false;
        }
        
        if (! isset($input['joinedDate'])) {
            return false;
        }
        if (! isset($input['photo'])) { 
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