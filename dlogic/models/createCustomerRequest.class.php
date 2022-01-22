<?php

class CREATECUSTOMERREQUEST {

    private $fullname;
    private $email;
    private $phone;
    private $address;
    private $dAddress;
    private $businessType;
    private $businessName;
    private $status;
    private $createdBy;

	public function getFullname(){
		return $this->fullname;
        
	}

	public function setFullname($fullname) {
		$this->fullname = $fullname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getDAddress() {
		return $this->dAddress;
	}

	public function setDAddress($dAddress) {
		$this->dAddress = $dAddress;
	}

	public function getBusinessType() {
		return $this->businessType;
	}

	public function setBusinessType($businessType) {
		$this->businessType = $businessType;
	}

	public function getBusinessName() {
		return $this->businessName;
	}

	public function setBusinessName($businessName) {
		$this->businessName = $businessName;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function getCreatedBy() {
		return $this->createdBy;
	}

	public function setCreatedBy( $createdBy) {
		$this->createdBy = $createdBy;
	}







}