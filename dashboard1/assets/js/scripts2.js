function checkValidate()
{
	var pwd,cpwd;
	pwd = document.getElementById("pwd").value;
	cpwd = 	document.getElementById("cpwd").value;
	if(pwd === cpwd)
		return true;
	else{
		alert("Password didn't match! Please try again.");
		pwd.value = "";
		cpwd.value="";
	return false;
	}
}