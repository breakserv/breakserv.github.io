function isBlank(formname, fieldname) {
	var fval = document.forms[formname][fieldname].value;
	if (fval == null || fval == "") {
		return true;
	}
	return false;
}