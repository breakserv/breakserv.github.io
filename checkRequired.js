function checkRequired() {
	var formN= "new";
	var userfields = ["fName", "lName", "Email", "Pass"];
	var unfilled = 0;

	// Alert for email (supersedes unfilled)
	if (!isBlank(formN, "Email") && !isEmail(document.forms[formN]["Email"].value)) {
		alert(document.forms[formN]["Email"].value + " is not a valid email! Please try again.");
		document.getElementById("EmailReq").innerHTML = "<b><font color='#FF0000'>Invalid Email</font></b>";
		return false;
	} else {
		document.getElementById("EmailReq").innerHTML = "";
	}

	// Test for blank fields
	for (i = 0; i < userfields.length; i++) {
		if (isBlank(formN, userfields[i])) {
			unfilled++;
			document.getElementById(userfields[i] + "Req").innerHTML = "<b><font color='#FF0000'>*Required</font></b>";
		} else {
			document.getElementById(userfields[i] + "Req").innerHTML = "";
		}
	}

	// Alert for unfilled
	if (unfilled > 0) {
		alert(unfilled + " fields were left blank or filled incorrectly. Please check your user information and resubmit.");
		return false;
	}
}
