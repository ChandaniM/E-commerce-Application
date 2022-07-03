
// window.onload=()=>{
// 	//Disabled when page loads
// 	classes('signup-submit-button')[0].disabled=true;
// 	classes('submit-button')[0].disabled=true;
// }
//ID and Classes
const ids=value=>document.getElementById(value);
const classes=value=>document.getElementsByClassName(value);

// const password=document.querySelector(".password");
// const repassword=document.querySelector(".repassword");


const passwordVerify=(password)=>{
	const regEx=/^(?=.+[a-z])(?=.+[A-Z])(?=.+[0-9])(?=.+[\$\%\^\&\!@\#\*\(\)\+\=`~\?\>\<])/
	return regEx.test(password) && password.length>=8 ? true : false;
}