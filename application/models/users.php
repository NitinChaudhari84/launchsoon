<?php

class users extends CI_Model {
	
    function __construct(){
		
		// Call the Model constructor
		parent::__construct();
		
		$this->load->library('commonstructure');

	}
	
	public function getUseDetails($arrParams){
		
		$arrReturn = array();
		$strWhere = "";
		
		$qrySel = "	SELECT * 
					FROM users
					WHERE ( endeffdt IS NULL OR endeffdt = '0000-00-00' OR endeffdt > '" . DATE("Y-m-d") . "' ) ";

		
		foreach ( $arrParams as $key => $value ) {
			switch ( strtoupper($key) ) {
				case "USERID" :
					( !empty($value) ) ? $strWhere .= " AND id = '" . $value . "' " : "";
				break;
				
				case "NOTUSERID" :
					( !empty($value) ) ? $strWhere .= " AND id != '" . $value . "' " : "";
				break;
				
				case "EMAIL" :
					( !empty($value) ) ? $strWhere .= " AND email LIKE '%" . $value . "%' " : "";
				break;
				
				case "SEARCH" :
					( !empty($value) ) ? $strWhere .= " AND (email LIKE '%" . $value . "%' OR firstname LIKE '%" . $value . "%' OR lastname LIKE '%" . $value . "%' OR username LIKE '%" . $value . "%') " : "";
				break;
			}
		}
		
		$qrySel .= $strWhere;
		
		$objDBResult = $this->db->query($qrySel);
		
		foreach ( $objDBResult->result_array() as $key => $rowGetInfo ) {
			$rowGetInfo = $this->commonstructure->getValue($rowGetInfo, "HE");
			$arrReturn[$rowGetInfo["id"]] = $rowGetInfo;
		}

		return $arrReturn;
		
	}
	
	public function addUserRecord( $arrParams ) {
		
		
		// Email Validation
		$strRegExp = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
		if ( !preg_match($strRegExp,$arrParams["email"]) ) {
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/IE";
			return false;
		}
		
		$arrGetUserParams = array();
		$arrGetUserParams["EMAIL"] = $arrParams["email"];
		$arrGetUserParams = $this->commonstructure->getValue($arrGetUserParams, "AS");
		$arrUserDetails = $this->getUseDetails($arrGetUserParams);
		$users = count($arrUserDetails);
		
		if ( $users == 0 ) {
	
			$qryIns = "	INSERT INTO users(firstname,lastname, username, email, datex, password)
						VALUES ('" . $arrParams["firstname"] . "',
								'" . $arrParams["lastname"] . "',
								'" . $arrParams["username"] . "',
								'" . $arrParams["email"] . "',
								'" . $arrParams["datex"] . "',
								'" . $arrParams["password"] . "') ";
								
			$objDBResult = $this->db->query($qryIns);
			
			return $objDBResult;
	
		}
		else{
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/AE";
			$this->commonstructure->autoRedirect($arrRedirectData);
		}
	}
	
	public function editUserRecord( $arrParams ) {
		
		// Email Validation
		$strRegExp = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
		if ( !preg_match($strRegExp,$arrParams["email"]) ) {
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/IE";
			return false;
		}
		
		$arrGetUserParams = array();
		$arrGetUserParams["EMAIL"] = $arrParams["email"];
		$arrGetUserParams["NOTUSERID"] = $arrParams["id"];
		$arrGetUserParams = $this->commonstructure->getValue($arrGetUserParams, "AS");
		$arrUserDetails = $this->getUseDetails($arrGetUserParams);
		$users = count($arrUserDetails);
		
		if ( $users == 0 ) {
		
			$qryUpd = "	UPDATE users u
						SET u.firstname = '" . $arrParams["firstname"] . "',
							u.lastname = '" . $arrParams["lastname"] . "',
							u.username = '" . $arrParams["username"] . "',
							u.email = '" . $arrParams["email"] . "',
							u.datex = '" . $arrParams["datex"] . "' 
						WHERE id = '" . $arrParams["id"] . "' ";
								
			$objDBResult = $this->db->query($qryUpd);
			
			return $objDBResult;
		
		}
		else{
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/AE";
			$this->commonstructure->autoRedirect($arrRedirectData);
		}
		
	}
	
	
	public function deleteUserAccount( $arrParams ) {
		
		if ( 0 ) {
			print("<pre>");
			print_r($arrParams);
			print("</pre>");
		}
		
		if ( $arrParams["id"] != 0 ) {
		
			$qryUpd = "	UPDATE users u
						SET u.endeffdt = '" . $arrParams["endeffdt"] . "'
						WHERE id = '" . $arrParams["id"] . "' ";
								
			$objDBResult = $this->db->query($qryUpd);
			
			return $objDBResult;
		
		}
		else{
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/AE";
			$this->commonstructure->autoRedirect($arrRedirectData);
		}
		
	}
	
	public function userAccountStatusChange( $arrParams ) {
		
		if ( 0 ) {
			print("<pre>");
			print_r($arrParams);
			print("</pre>");
		}
		
		if ( $arrParams["id"] != 0 ) {
		
			$qryUpd = "	UPDATE users u
						SET u.status = IF(u.status = 'Y', 'N', 'Y')
						WHERE u.id = '" . $arrParams["id"] . "' ";
								
			$objDBResult = $this->db->query($qryUpd);
			
			return $objDBResult;
		
		}
		else{
			$arrRedirectData["FILENAME"] = "backend/login/mainlist/AE";
			$this->commonstructure->autoRedirect($arrRedirectData);
		}
		
	}
	
}