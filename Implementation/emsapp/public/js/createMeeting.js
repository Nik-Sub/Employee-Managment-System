// Created by Boris Martinovic 2020/0582

$(document).ready(function(){

    let foundEmployees = [];

    
    const validate = dateString => {
        const day = (new Date(dateString)).getDay();
        
        if(day == 0 || day == 6){
            return false;
        }

        return true;
    }

    document.querySelector("#meetDate").onchange = evt => {
        if(!validate(evt.target.value)){
            evt.target.value = '';
        }
    }

    var result = new Date();
    result.setDate(result.getDate() + 1);
    var tommorow = result.toISOString().split('T')[0];
    $("#meetDate").attr('min', tommorow);

    $("#addParticipant").click(openInput);
    $("#listAddBtn").click(addToList);
    $("#inputCloseBtn").click(closeInput);

    $(".timeSelect").change(function(e){
        let timeFrom = document.getElementById("timeFrom");
        let timeTo = document.getElementById("timeTo");

        let indexFrom = timeFrom.options[timeFrom.selectedIndex].index;
        let indexTo = timeTo.options[timeTo.selectedIndex].index;

        if(indexTo == 0){
            
            let op = timeTo.getElementsByTagName("option");

            for(let i = 1; i < op.length; i++){
                
                if(i <= indexFrom){

                    op[i].disabled = true;
                    op[i].hidden = true;

                }

                else{

                    op[i].disabled = false;
                    op[i].hidden = false;

                }
            }

        }
        else if(indexFrom == 0){
            
            let op = timeFrom.getElementsByTagName("option");

            for(let i = 1; i < op.length; i++){
                
                if(i < indexTo){

                    op[i].disabled = false;
                    op[i].hidden = false;

                }

                else{

                    op[i].disabled = true;
                    op[i].hidden = true;

                }
            }
        }

        else if(e.currentTarget == timeFrom){
            
            let op = timeTo.getElementsByTagName("option");

            for(let i = 1; i < op.length; i++){
                
                if(i <= indexFrom){

                    op[i].disabled = true;
                    op[i].hidden = true;

                }

                else{

                    op[i].disabled = false;
                    op[i].hidden = false;

                }
            }
        }

        else{
            let op = timeFrom.getElementsByTagName("option");

            for(let i = 1; i < op.length; i++){
                
                if(i < indexTo){

                    op[i].disabled = false;
                    op[i].hidden = false;

                }

                else{

                    op[i].disabled = true;
                    op[i].hidden = true;

                }
            }
        }
    });

    let timeArr = ["08:00", "08:15", "08:30", "08:45", "09:00", "09:15", "09:30", "09:45", "10:00", "10:15",
                  "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45",
                  "13:00", "13:15", "13:30", "13:45", "14:00", "14:15", "14:30", "14:45", "15:00", "15:15", "15:30", "15:45", "16:00"];


    for(let i = 0; i < timeArr.length - 1; i++){
        let tmp = $("<option></option>");
        tmp.text(timeArr[i]);
        $("#timeFrom").append(tmp);
    }

    for(let i = 0; i < timeArr.length; i++){
        let tmp = $("<option></option>");
        tmp.text(timeArr[i]);
        $("#timeTo").append(tmp);
    }


    async function addToList(){

        if($("#emailField").val() == "") return;

        newParticipant = await getEmployee($("#emailField").val());
        if(newParticipant == null) return; //moze se dodati i neki alert

        let exists = false;

        $(".employees").each(function(){
            if($(this).val() == newParticipant["idemployee"]){
                exists = true;
            }
        });

        if(exists){
            return;
        }

        let newElem = $("<div></div>");
        newElem.addClass("participant-icon");

        let newElemImg = $("<img>");
        let imgSrc = "../img/" + newParticipant["picture"];
        
        newElemImg.attr("src", imgSrc);

        let newDiv = $("<div></div>");
        let newBr = $("<br>");

        let newName = $("<span></span>");
        newName.addClass("participant-name");
        newName.text(newParticipant["firstName"] + " " + newParticipant["lastName"]);

        let newId = $("<input>");
        newId.attr("type", "hidden");
        newId.addClass("employees");
        newId.val(newParticipant["idemployee"]);

        let newEmail = $("<span></span>");
        newEmail.addClass("participant-email");
        newEmail.text(newParticipant["email"]);

        let newBtn = $("<a></a>");
        newBtn.addClass("remove-button");
        newBtn.text("Remove");

        newBtn.click(function(){

            let wasLast = newBtn.parent().hasClass("last");

            newBtn.parent().remove();

            if(wasLast){
                $(".participant-icon").last().addClass("last");
            }

        });

        newDiv.append(newName);
        newDiv.append(newBr);
        newDiv.append(newEmail);
        newDiv.append(newId);

        newElem.append(newElemImg);
        newElem.append(newDiv);
        newElem.append(newBtn);

        let lastNode = $(".last").last();
        lastNode.removeClass("last");
        newElem.addClass("last");
        lastNode.after(newElem);

        closeInput();
    }

    function openInput(){
        $("#inputParticipant").show();
        $("#emailField").focus();
    }

    function closeInput(){
        $("#inputParticipant").val("");
        $("#inputParticipant").hide();
        $("#emailField").val("");
    }


    $("#submitForm").submit(function(){

        let tmp = "";

        $(".employees").each(function(){
            tmp += $(this).val();
            tmp += ":";
        });

        $("#participants").val(tmp);

    });

    $("#searchList").hide();

    $('#emailField').on('keyup', function(){
        search();
    });

    async function search(){

        var keyword = $('#emailField').val();
        
        let ret = await $.ajax({
            method: "POST",
            url: "/employeeSearch",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{"keyword": keyword} 
        });

        if(ret.employees == null){
            $("#searchList").hide();
            $("#searchList").empty();
            return;
        }

        $("#searchList").hide();
        if(ret.employees.length != 0){
            $("#searchList").show();
        }

        //remove prev
        $("#searchList").empty();

        //add curr

        for(let i = 0; i < ret.employees.length; i++){
            let newItem = $("<li></li>");
            newItem.addClass("searchListItem");

            let newName = $("<p></p>");
            newName.text(ret.employees[i]["firstName"] + " " + ret.employees[i]["lastName"]);
            newName.addClass("searchListName");

            let newEmail = $("<p></p>");
            newEmail.text(ret.employees[i]["email"]);

            newItem.append(newName);
            newItem.append(newEmail);
            
            newItem.click(function(){
                $('#emailField').val(newEmail.text());
                $("#searchList").hide();
                $("#searchList").empty();
            });

            $("#searchList").append(newItem);
        }
    }

    async function getEmployee(email){

        let ret = await $.ajax({
            method: "POST",
            url: "/getEmployee",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{"email": email}

        });
        
        return ret.employee;
    }

})