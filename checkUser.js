function checkUser() {
	var formN= "editU";

	// Test for current password!
	if (document.forms['editU']['currpass'].value != document.forms['editU']['Pass'].value) {
		alert("You have entered an incorrect password! Please try again.");
		return false;
	}
}
