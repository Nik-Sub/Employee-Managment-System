$(document).ready(function(){
  let upcomingBtn = document.querySelector("#upcoming-tab");
  let heldBtn = document.querySelector("#held-tab");
  let upcomingContent = document.querySelector("#upcoming-tab-pane");
  let heldContent = document.querySelector("#held-tab-pane");

  $("#upcoming-tab").click(function(){
    if(upcomingBtn.classList.contains("active")){
      return;
    }
    heldBtn.classList.remove("active");
    heldContent.classList.remove("show");
    heldContent.classList.remove("active");
    upcomingBtn.classList.add("active");
    upcomingContent.classList.add("show");
    upcomingContent.classList.add("active");
  });

  $("#held-tab").click(function(){
    if(heldBtn.classList.contains("active")){
      return;
    }
    upcomingBtn.classList.remove("active");
    upcomingContent.classList.remove("show");
    upcomingContent.classList.remove("active");
    heldBtn.classList.add("active");
    heldContent.classList.add("show");
    heldContent.classList.add("active");
  });
});
