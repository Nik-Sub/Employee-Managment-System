// Created by Boris Martinovic 2020/0582

$(document).ready(function(){
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
  
    let logOutBtn = document.querySelector("#log_out");
    
    logOutBtn.addEventListener("click", ()=>{
        window.location.href = 'login.html';
    });
  
    closeBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("open");
        menuBtnChange();
    });
    
    function menuBtnChange() {
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
        }
    }

    // function openInput(){
    //     let p = document.getElementById("inputParticipant");
    //     p.style.display = "block";
    // }

    // function closeInput(){
    //     let p = document.getElementById("inputParticipant");
    //     p.style.display = "none";
    // }

    // function removeParticipant(){
    //   event.srcElement.parentElement.style.display = "none";
    //   //todo izbaci iz liste kad se bude implementiralo
    // }




    $(".delete-button").on("click", function (){
         return confirm('Are you sure you want to delete this employee?');
    });

    $(".delete-meeting").on("click", function (){
        return confirm('Are you sure you want to delete this employee?');
   })

})