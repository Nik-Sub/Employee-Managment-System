// Created by Nikola Šubarić 2020/0271 

$(document).ready(function(){
    // add picture

    let imgDiv = document.querySelector('.profilePicDiv');
    let img = document.querySelector('#photo');
    let picForAcc = document.querySelector('#picForAcc');
    let uploadBtn = document.querySelector("#uploadBtn");

    // if user hover on profilePic div
    
    imgDiv.addEventListener('mouseenter', function(){
        uploadBtn.style.display = "block";
    });

    //if we hover out from profilePic div
    imgDiv.addEventListener('mouseleave', function(){
    uploadBtn.style.display = "none";
    });

    imgDiv.addEventListener('click', function(){
        picForAcc.click();
    });
    
    // when we choose a foto to upload
    picForAcc.addEventListener('change', function(){


        // this refers to file
        const choosedFile = this.files[0];

        if (choosedFile){
            const reader = new FileReader();
            reader.addEventListener('load', function(){
                img.setAttribute('src', reader.result);
            })

            reader.readAsDataURL(choosedFile);

            
        }
        
    })
    

    //max date of birth

    let datePickerId = document.getElementById("datePickerId");
    if (datePickerId)
        datePickerId.max = new Date().toISOString().split("T")[0];

    function validFormatOfPass(){
        let pw = $("#pass").val();
          
        //minimum password length validation  
        if( pw != "" && pw.length < 8) {  
            document.getElementById("passMess").innerHTML = "**Password length must be atleast 8 characters";  
            return false;  
        }  
         
        //maximum length of password validation  
        if( pw != "" && pw.length > 15) {  
            document.getElementById("passMess").innerHTML = "**Password length must not exceed 15 characters";  
            return false;  
        }
        else{
            document.getElementById("passMess").innerHTML = "";  
            return true;
        }
    }

    function confirmEmail(){
        let email = $("#email").val();
        let submit = $("#sub");
        //submit.prop('disabled', true);
        if (email == ""){
            return false;
        }
        if (/^[a-z0-9]{1,}@.+$/.test(email)){
            document.getElementById("emailMess").innerHTML = "";  
            //submit.prop('disabled', false);
            return true;
        }
        else{
            document.getElementById("emailMess").innerHTML = "**Format of email: one or more characters or numerics before @ and at least one character after @"; 
            return false;
        }
    }

    function confirmPassword(){
        let pass = $("#pass").val();
        let confPass = $("#confPass").val();
        let submit = $("#sub");
        //submit.prop('disabled', true);

        // ako je u pitanju update account onda moze da bude prazno polje za sifru
        if ($("#check").attr("name") == "uA" && pass == "")
            return true;

        if (pass != confPass){
            document.getElementById("confPassError").innerHTML = "**Confirm password is not the same as password!";  
            return false;
        }
        else if (confPass != "" && confPass.length >= 8 && confPass.length <= 15){
            document.getElementById("confPassError").innerHTML = "**Confirm password is the same as password!";  
            //submit.prop('disabled', false);
            return true;
        }
        else{
            document.getElementById("confPassError").innerHTML = "";  
            return false;
        }

    }
    let h1;
    //let h2;
    //let h4;
    //h1 = setInterval(validFormatOfPass, 0);
    //h2 = setInterval(confirmPassword, 0);
    //h4 = setInterval(confirmEmail, 0);
    h1 = setInterval(overallCheck, 0);


    $("#sub").click(function(){
        
        if ($("#name").val() == "" || $("#lastName").val() == "" || $("#datePickerId").val() == "" || $("#department").val() == "" || $("#role").val() == "" || $("#email").val() == "" )
            return;
  

        clearInterval(h1);
        //clearInterval(h2);
        //clearInterval(h3);
        //clearInterval(h4);
    })


    // this is for updateAccount
    function checkForNewPassword(){
        if ($("#check").attr("name") != "uA")
            return;
        
        if ($("#pass").val() != ""){
            h1 = setInterval(validFormatOfPass, 0);
            h2 = setInterval(confirmPassword, 0);
        }
        else{
            $("#sub").prop('disabled', false);
            clearInterval(h1);
            clearInterval(h2);
        }
    }
    
    //let h3 = setInterval(checkForNewPassword, 0);

    function overallCheck(){
        let submit = $("#sub");
        validFormatOfPass();
        let v2 = confirmEmail();
        let v3 = confirmPassword();
        submit.prop('disabled', !v2 || !v3);
    }
})