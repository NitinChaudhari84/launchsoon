function checkValue(objForm, fieldName, displayName, number){
	
	objField = document.getElementById(fieldName);
		
	if(objField != null){
		fieldValue = document.getElementById(fieldName).value;
		if(fieldValue.trim() == ""){
			objField.focus();
			alert(displayName);
			return false;
		}
		else{
			if(number){
				if(isNaN(fieldValue)){
					objField.focus();
					alert("Please valid value in "+ displayName +".");
					return false;
				}
			}
			else{
				if(!isNaN(fieldValue)){
					objField.focus();
					alert("Please valid value in "+ displayName +".");
					return false;
				}
			}
			return true;
		}

	}
	else{
		alert("Please check field name.");
		return false;
	}
}

function checkEmail(objForm, fieldName){
	objField = document.getElementById(fieldName);
	if(objField != null){
		fieldValue = document.getElementById(fieldName).value;
		filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
		if (!filter.test(fieldValue)) {
			objField.focus();
			alert("Please enter valid email.");
			return false;
		}
		else{
			return true;
		}
	}
	else{
			return false;
	}
}