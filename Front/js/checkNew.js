$("#avert").bind("click", (function () {
       
        document.getElementById('detAlert').style.display = "block";
       

    }
));

$("#prop").bind("click", (function () {
       
    document.getElementById('validProp').style.display = "block";
   

}
));

$("#valid1").bind("click", (function () {
    var info=''; var t=0;
    if(document.getElementById('propOk_AR').checked) {info='AR';}
    if(document.getElementById('propOk_mail').checked) {info=info+'/MAIL';}
    if(document.getElementById('propOk_poste').checked) {info=info+'/POSTE';}
    if(document.getElementById('propOk_site').checked) {info=info+'/WEB';}
    if(document.getElementById('propOk_tel').checked) {info=info+'/TEL';}
    if(info == '') {t=1;}

    if(document.getElementById('datepicker').value == '') {t=1;}
    
    if (t == 0) {
    var datastring = 'action=proprio&signId=' + document.getElementById('sign').value + '&mode='+info+'&dt='+document.getElementById('datepicker').value ;
    
    //alert (datastring);
    $.ajax({
        type: "POST",
        url:"updateSign.php",
        data:datastring      
    });

            document.getElementById("info1").style.display = "none";
            document.getElementById("prop").style.display = "none";
            document.getElementById("validProp").style.display = "none";
            document.getElementById("text_certifKO").style.display = "none";
            document.getElementById("detAlert").style.display = "none";
            document.getElementById("text_certifOK").style.display = "block";
    } else {
        alert ('Merci de renseigner un mode d\'information et la date.')
    }
   
}
));


$("#annul").bind("click", (function () {
    var datastring = 'action=proprioKO&signId=' + document.getElementById('sign').value;
    //alert (datastring);
    $.ajax({
        type: "POST",
        url:"updateSign.php",
        data:datastring      
    });
    document.getElementById("text_certifOK").style.display = "none";
            document.getElementById("info1").style.display = "block";
            document.getElementById("prop").style.display = "block";
            document.getElementById("validProp").style.display = "block";
            document.getElementById("propOk").checked = false;
            document.getElementById("text_certifKO").style.display = "block";
            

   
}
));

$("input:radio[name=alim]").bind("change", (function () {
    var datastring = 'action=nrj&signId=' + document.getElementById('sign').value + '&modeNrj='+ document.querySelector('input[name="alim"]:checked').value;
    //alert (datastring);
    $.ajax({
        type: "POST",
        url:"updateSign.php",
        data:datastring      
    });
    document.getElementById("modeN").style.display = "none";
    document.getElementById("modeOK").style.display = "block";
    document.getElementById("annulModeN").style.display = "block";
    }
));


$("#annulMode").bind("click", (function () {
    var datastring = 'action=nrj&signId=' + document.getElementById('sign').value + '&modeNrj=?';
   // alert (datastring);
    $.ajax({
        type: "POST",
        url:"updateSign.php",
        data:datastring      
    });
    document.getElementById("annulModeN").style.display = "none";
    document.getElementById("modeOK").style.display = "none";
    document.getElementById("modeN").style.display = "block";

    document.getElementById('alim1').checked = false;
    document.getElementById('alim2').checked = false;
    }
));


$("#sendPh").bind("click", (function () {
  
    document.getElementById("sPh").style.display = "none";
    document.getElementById('waitPh').style.display = "block";
    document.getElementById('addPhotos').submit();
    }
));


function chSitOn(element, img) {
    element.setAttribute('src', 'img/'+img+'_on.png');
}
function chSitOff(element, img) {
    element.setAttribute('src', 'img/'+img+'_off.png');
}


 $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            language: "fr",
            beforeShowDay: $.datepicker.noWeekends,
            orientation: "auto left"
        });
        

