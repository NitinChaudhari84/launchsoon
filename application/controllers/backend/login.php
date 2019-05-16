<?php 
	
	class login extends CI_Controller {
		
		// Call the Model constructor
		function __construct(){
			
			parent::__construct();
			
			//helper
			$this->load->helper('url');
			
			//library
			$this->load->library('commonstructure');
			
			//model
			$this->load->model('users');
			
			//initial function 
			$this->setFilterParameters();

		}
		
		function _remap($method, $args){
			if (method_exists($this, $method)){
				$this->$method($args);
			}
			else{
				$this->mainList($args);
			}
		}
		
		public function mainList($arrQryStr = Null) { 
				
			$arrRequest = $this->commonstructure->getValue($_REQUEST, "AS");
			$arrSearchParams = $this->getFilterParameters();
			
			
			$arrGetUserParams = array();
			$arrGetUserParams['SEARCH'] = $arrSearchParams['txtSearch'];
			$arrGetUserParams = $this->commonstructure->getValue($arrGetUserParams, "AS");
			$arrUserDetails = $this->users->getUseDetails($arrGetUserParams);
			
			foreach ( $arrUserDetails as $userId => $arrUserInfo ) {
				$arrUserDetails[$userId]["edit"] = base_url() . "backend/login/addEdit/".$userId;
				$arrUserDetails[$userId]["delete"] = base_url() . "backend/login/deleteUser/".$userId;
				$arrUserDetails[$userId]["status"] = base_url() . "backend/login/statusChange/".$userId;
				$arrUserDetails[$userId]["strStatus"] = "In Active";
				if ( $arrUserInfo["status"] == "Y" ){
					$arrUserDetails[$userId]["strStatus"] = "Active";
				}
			}
			
			$arrMainContent = array();
			$arrMainContent["doAction"] = "";
			$arrMainContent["arrSearchParams"] = $arrSearchParams;
			$arrMainContent["arrUserDetails"] = $arrUserDetails;
			
			$arrMainContent["add"] = base_url() . "backend/login/addEdit";
			
			$this->load->view('backend/maincontent', $arrMainContent);
		}
		
		public function addEdit($arrQryStr = Null) { 
				
			$arrUserDetails = $this->modGetUserInformation();
			
			$arrMainContent = array();
			$arrMainContent["doAction"] = "addEdit";
			$arrMainContent["arrUserDetails"] = $arrUserDetails;
			$arrMainContent["userId"] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;;
			if ( !empty($arrMainContent["userId"]) ) {
				$arrMainContent["addRecord"] = base_url() . "backend/login/editRecord";
				$arrMainContent["button"] = "Update";
			}
			else{
				$arrMainContent["addRecord"] = base_url() . "backend/login/addRecord";
				$arrMainContent["button"] = "Add";
			}
			
			$this->load->view('backend/maincontent', $arrMainContent);
		}
		
		public function addRecord($arrQryStr = Null) { 
			
			// This is for get REQUEST
			$arrRequest = $this->commonstructure->getValue($_REQUEST, "AS");
			
			// Password and confirm Password Match
			if ( $arrRequest["txtPassword"] != $arrRequest["txtConfirmPassword"] ) {
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/PN";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
				
			// Insert User Data
			$arrInsertData = array();
			$arrInsertData["firstname"] = $arrRequest["txtFirstName"];
			$arrInsertData["lastname"] = $arrRequest["txtLastName"];
			$arrInsertData["username"] = $arrRequest["txtUserName"];
			$arrInsertData["email"] = $arrRequest["txtEmail"];
			$arrInsertData["datex"] = DATE("Y-m-d");
			$arrInsertData["password"] = md5($arrRequest["txtPassword"]);
		
			if ( $this->users->addUserRecord($arrInsertData) ) {
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/SS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
			else{
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
				
			
		}
		
		public function editRecord($arrQryStr = Null) { 
			
			// This is for get REQUEST
			$arrRequest = $this->commonstructure->getValue($_REQUEST, "AS");
							
			// Insert User Data
			$arrUpdateData = array();
			$arrUpdateData["firstname"] = $arrRequest["txtFirstName"];
			$arrUpdateData["lastname"] = $arrRequest["txtLastName"];
			$arrUpdateData["username"] = $arrRequest["txtUserName"];
			$arrUpdateData["email"] = $arrRequest["txtEmail"];
			$arrUpdateData["id"] = $arrRequest["hidUserId"];
			$arrUpdateData["datex"] = DATE("Y-m-d");
			
			if ( $this->users->editUserRecord($arrUpdateData) ) {
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/SS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
			else{
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
			
		}
		
		
		public function deleteUser($arrQryStr = Null) { 
			
			$userId = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
			
			if ( !empty($userId) ) {
				
				$arrUpdateData = array();
				$arrUpdateData["endeffdt"] = DATE("Y-m-d");
				$arrUpdateData["id"] = $userId;
				
				if ( $this->users->deleteUserAccount($arrUpdateData) ) {
					$arrRedirectData["FILENAME"] = "backend/login/mainlist/SS";
					$this->commonstructure->autoRedirect($arrRedirectData);
				}
				else{
					$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
					$this->commonstructure->autoRedirect($arrRedirectData);
					
				}
				
			}
			else{
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
	
		}
		
		public function statusChange() {
			
			$userId = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
			
			if ( !empty($userId) ) {
				
				$arrUpdateData = array();
				$arrUpdateData["id"] = $userId;
				
				if ( $this->users->userAccountStatusChange($arrUpdateData) ) {
					$arrRedirectData["FILENAME"] = "backend/login/mainlist/SS";
					$this->commonstructure->autoRedirect($arrRedirectData);
				}
				else{
					$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
					$this->commonstructure->autoRedirect($arrRedirectData);
					
				}
				
			}
			else{
				$arrRedirectData["FILENAME"] = "backend/login/mainlist/NS";
				$this->commonstructure->autoRedirect($arrRedirectData);
			}
			
		}
		
		public function modGetUserInformation() {
			
			$arrReturn = array();
			
			$arrGetUserParams = array();
			$arrGetUserParams["USERID"] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
			$arrGetUserParams = $this->commonstructure->getValue($arrGetUserParams, "AS");
			$arrUserDetails = $this->users->getUseDetails($arrGetUserParams);
		
			if ( !empty($arrGetUserParams["USERID"]) ) {
				$arrReturn["firstname"] = $arrUserDetails[$arrGetUserParams["USERID"]]["firstname"];
				$arrReturn["lastname"] = $arrUserDetails[$arrGetUserParams["USERID"]]["lastname"];
				$arrReturn["username"] = $arrUserDetails[$arrGetUserParams["USERID"]]["username"];
				$arrReturn["email"] = $arrUserDetails[$arrGetUserParams["USERID"]]["email"];
			}
			else{
				$arrReturn["firstname"] = "";
				$arrReturn["lastname"] = "";
				$arrReturn["username"] = "";
				$arrReturn["email"] = "";
			}
			
			return $arrReturn;
			
		}
		
		public function setFilterParameters() {

			$arrRequest = $this->commonstructure->getValue($_REQUEST, "AS");
			$arrSearch['SEARCH'] = array();
			
			if ( isset($arrRequest['txtSearch']) ) {
				$arrSearch['SEARCH'] = json_encode($arrRequest);
				$this->session->set_userdata($arrSearch);
			}
		}
		
		public function getFilterParameters() {
			$strRequest = $this->session->userdata('SEARCH');
			$arrReturnSearchParmas = json_decode($strRequest, true);
			return $arrReturnSearchParmas;
		}
		
	}
	
?>