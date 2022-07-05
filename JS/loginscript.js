  document.getElementById('password-eye').addEventListener('click',()=>{
      let display_pass=document.getElementById('display-pass');
      if(!display_pass.classList.contains('d-none')){
          document.getElementById('hide-pass').classList.remove('d-none');
          document.getElementById('password').type="text";
          display_pass.classList.add('d-none')
      }else{
          document.getElementById('hide-pass').classList.add('d-none');
          document.getElementById('password').type="password";
          display_pass.classList.remove('d-none')
      }
      
  });
  document.getElementById('password-eye-confrom').addEventListener('click',()=>{
      let display_pass=document.getElementById('display-pass-confrom');
      if(!display_pass.classList.contains('d-none')){
          document.getElementById('hide-pass-confrom').classList.remove('d-none');
          document.getElementById('conpass').type="text";
          display_pass.classList.add('d-none')
      }else{
          document.getElementById('hide-pass-confrom').classList.add('d-none');
          document.getElementById('conpass').type="password";
          display_pass.classList.remove('d-none')
      }
      
  });

  function vaildation() {
       const firstName=document.getElementById('firstName').value;
            const lastName=document.getElementById('lastName').value;
            const password=document.getElementById('password').value;
            const conpass=document.getElementById('conpass').value;
            const email=document.getElementById('email').value;
            const phone=document.getElementById('phone').value;
            const address=document.getElementById("address").value;

            const userchecker=/^[A-Za-z]{3,30}$/ ;
            const passwordchecker=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/ ;
            const emailchecker=/^[A-Za-z0-9]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/ ;
            const mobilechecker=/^[0-9]{10}$/ ;
            // fisrt name 
             if(userchecker.test(firstName)){
                document.getElementById('firsterror').innerHTML=" ";

             }
             else{
                document.getElementById('firsterror').innerHTML="** Fisrt name is invaild";
                return false;
             }
             // last name
            if(userchecker.test(lastName)){
                document.getElementById('lasterror').innerHTML=" ";

             }
             else{
                document.getElementById('lasterror').innerHTML="** Last name is invaild";
                return false;
             }
      // Email
             if(emailchecker.test(email)){
                document.getElementById('emailerror').innerHTML=" ";

             }
             else{
                document.getElementById('emailerror').innerHTML="** Email is invaild";
                return false;
             }
             // Address
              if(address.length>0){
                document.getElementById('addresserror').innerHTML=" ";

             }
             else{
                document.getElementById('addresserror').innerHTML="** Address cannot be empty";
                return false;
             }
               // phone
             if(mobilechecker.test(phone)){
                document.getElementById('phoneerror').innerHTML=" ";

             }
             else{
                document.getElementById('phoneerror').innerHTML="** number is invaild";
                return false;
             }
             // password 
              if(passwordchecker.test(password)){
                document.getElementById('passerror').innerHTML=" ";

             }
             else{
                document.getElementById('passerror').innerHTML="** password is invaild";
                return false;
             }
             // conform password
             if(conpass.match(password)){
                 document.getElementById('confromerror').innerHTML=" ";

             }
             else{
                document.getElementById('confromerror').innerHTML="** password is not matching";
                return false;
             }

           


        }
