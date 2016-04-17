function checkTrip() {
	var formN= "new";
	var tripfields = ["oCity", "dCity", "oState", "dState", "dDate", "dTime", "Seats"];
	var unfilled = 0;

	// Test for blank fields
	for (i = 0; i < tripfields.length; i++) {
		if (isBlank(formN, tripfields[i])) {
			unfilled++;
			document.getElementById(tripfields[i] + "Req").innerHTML = "<b><font color='#FF0000'>*</font></b>";
		} else {
			document.getElementById(tripfields[i] + "Req").innerHTML = "";
		}
	}

	// Alert for unfilled
	if (unfilled > 0) {
		alert(unfilled + " fields were left blank or filled incorrectly. Please check your trip information and resubmit.");
		return false;
	}
}
