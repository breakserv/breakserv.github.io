function loadSplashPage() {
	var flag=getCookie("PEAR");
	if (flag != "yes") {
		setCookie("PEAR","yes",365);
		window.location = "PEARsplash.html";
	}
   // complete this function
}
