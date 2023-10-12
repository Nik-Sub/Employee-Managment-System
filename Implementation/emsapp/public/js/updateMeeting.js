// Created by Boris Martinovic 2020/0582


$(document).ready(function(){


    let phpTimeFrom = $("#phpTimeFrom").val();
    let phpTimeTo = $("#phpTimeTo").val();

    $(".participant-icon").last().addClass("last");

    let elems = $(".participant-icon");
    
    let flag = true;

    $(".participant-icon").each(function(){

        if(flag){
            flag = false;
            return;
        }

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

        $(this).append(newBtn);
    });

    let parsedTimeFrom = phpTimeFrom.split(" ")[1].split(":")[0] + ":" + phpTimeFrom.split(" ")[1].split(":")[1];
    let parsedTimeTo = phpTimeTo.split(" ")[1].split(":")[0] + ":" + phpTimeTo.split(" ")[1].split(":")[1];
    let tmpDate = new Date(phpTimeFrom.split(" ")[0]);
    let parsedDate = tmpDate.toISOString().split('T')[0];

    $("#meetDate").val(parsedDate);

    let timeFrom = document.getElementById("timeFrom");
    let timeTo = document.getElementById("timeTo");
    
    let op1 = timeFrom.getElementsByTagName("option");
    for(let i = 1; i < op1.length; i++){

        if(op1[i].innerHTML == parsedTimeFrom){
            op1[i].selected = 'selected';
        }

    }

    let op2 = timeTo.getElementsByTagName("option");
    for(let i = 1; i < op2.length; i++){

        if(op2[i].innerHTML == parsedTimeTo){
            op2[i].selected = 'selected';
        }

    }

    $("#timeFrom").trigger("change");
    $("#timeTo").trigger("change");
    
})