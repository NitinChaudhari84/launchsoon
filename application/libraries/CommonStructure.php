<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CommonStructure {
	
    function __construct(){

	}
	
	public function getValue($arrValue,$secure){
		
		$arrReturnValue = array();
		
		if(is_array($arrValue)){
			
			foreach($arrValue as $key => $value){
				
				if(is_array($value)){
					$this->getValue($value,$secure);
				}
				
				switch($secure){
					case 'AS':
						$arrReturnValue[$key] = addslashes($value);
					break;
					
					case 'HE':
						$arrReturnValue[$key] = htmlentities($value);
					break;
					
					case 'HS':
						$arrReturnValue[$key] = htmlspecialchars($value);
					break;
					
					case 'SS':
						$arrReturnValue[$key] = stripslashes($value);
					break;
				}
			}
		}
		else{
			
			switch($secure){
				case 'AS':
					$arrReturnValue = addslashes($value);
				break;
				
				case 'HE':
					$arrReturnValue[$key] = htmlentities($value);
				break;
				
				case 'HS':
					$arrReturnValue[$key] = htmlspecialchars($value);
				break;
			}
		}
		
		return $arrReturnValue;
	}
	
	public function autoRedirect($arrRedirectData){
		header('location:'. base_url() . $arrRedirectData['FILENAME']);
	}
}

?>