/*!
* Start Bootstrap - Heroic Features v5.0.6 (https://startbootstrap.com/template/heroic-features)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-heroic-features/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project


/*
TODO:

 - Verander url na https://ewigeligapp.co.za/ks/...
 

*/

    setTimeout(function(){
   window.location.reload(1);
}, 60000);

/*function putStatus() {
    $.ajax({
        type: "GET",
        url: "https://ewigeligapp.co.za/ks/update.php",
        data: {toggle_select: true},
        success: function (result) {
            if (result == 1) {
                $('#customSwitch1').prop('checked', true);
                statusText(1);
            } else {
                $('#customSwitch1').prop('checked', false);
                statusText(0);
            }
            lastUpdated();
        }
    });
}*/

function GetSelectedTextValue(ddlSuggestion) {
    var selectedValue = ddlSuggestion.value;
    if (selectedValue == "Nuut") {
        document.getElementById("category_text").setAttribute("value","");
       document.getElementById("category_text").style.display = "";
       document.getElementById("category").style.display = "none";
       
    }
    else {
       document.getElementById("category_text").style.display = "none";
       document.getElementById("category_text").setAttribute("value",selectedValue);
    }
 }

function putStatus_id(x) {
    $.ajax({
        type: "GET",
        url: "update.php",
        data: {toggle_select: true, id: x},
        success: function (result) {
            if (result == 1) {
                $('#'+ x).prop('checked', true);
                statusText(1, x);
            } else {
                $('#' + x).prop('checked', false);
                statusText(0, x);
            }
            lastUpdated(x);
        }
    });
}

function statusText(status_val, sid) {
    if (status_val == 1) {
        var status_str = "On (1)";
    } else {
        var status_str = "Off (0)";
    }
    //document.getElementById("statusText"+sid).innerText = status_str;
}

function onToggle() {
    $('#toggleForm :checkbox').change(function () {
        if (this.checked) {
            //alert('checked');
            updateStatus(1, this.id);
            statusText(1, this.id);
        } else {
            //alert('NOT checked');
            updateStatus(0, this.id);
            statusText(0, this.id);
        }
    });
}

function updateStatus(status_val, sid) {
    $.ajax({
        type: "POST",
        url: "update.php",
        data: {toggle_update: true, status: status_val, id: sid},
        success: function (result) {
            console.log(result);
            lastUpdated(sid);
        }
    });
}

function lastUpdated(sid) {
    $.ajax({
        type: "GET",
        url: "update.php",
        data: {toggle_updated: true, id: sid},
        success: function (result) {
            document.getElementById("updatedAt"+sid).innerText = "(" + result + ")";
        }
    });
}
$(document).ready(function () {
    //Called on page load:
    //putStatus();
    //putStatus_id(1);
    onToggle();
    //statusText();
    //lastUpdated();
});
