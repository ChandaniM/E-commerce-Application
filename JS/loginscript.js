window.onload=()=>{
	//Disabled when page loads
	classes('signup-submit-button')[0].disabled=true;
	classes('submit-button')[0].disabled=true;
}

const password=document.querySelector(".password");
const repassword=document.querySelector(".repassword");


if(password==repassword){
		alert("correct")
}
