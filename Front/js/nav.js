
$("#stepnext2").bind("click", (function () {
    var datastring = 'step=1&etat=before';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    
     var valid=checkFormStep1();
    if (valid==true) {
        var datastring = 'step=1&etat=after';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
    
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
        window.scrollTo(0, 0);
    }
})); 
 
$("#stepnext3").bind("click", (function () {
    var datastring = 'step=2&etat=before';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    
    var valid=checkFormStep2();
    if (valid==true) {
        var datastring = 'step=2&etat=after';
            $.ajax({
                type: "POST",
                url:"updateUsage.php",
                data:datastring      
            });
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "block";
        window.scrollTo(0, 0);
    }
    
}));

$("#stepnext4").bind("click", (function () {
    var datastring = 'step=4&etat=before';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    var valid=checkFormStep3();
    if (valid==true) {
        var datastring = 'step=4&etat=after';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
        maj();
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "block";
        window.scrollTo(0, 0);
    }
}));

$("#stepnext5").bind("click", (function () {
    var datastring = 'step=5&etat=before';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    var valid=checkFormStep4();
    if (valid==true) {
        var datastring = 'step=5&etat=after';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
        document.getElementById('signale').submit();
        document.getElementById("step4").style.display = "none";
        document.getElementById("step5").style.display = "block";
        window.scrollTo(0, 0);
    }
}));


function checkFormStep1() {
    if (countCheckedJQuery() < 1){
         document.getElementById("errCrits").style.display = "block";
         return false;
        } else {
         return true;
        }
  
}

function checkFormStep2() {
    const str3=document.getElementById("desc").value;
    if(str3=="" || str3.length < 10 ) {
        document.getElementById("desc").className = "rf-input rf-input--error";
        document.getElementById("errDesc").style.display = "block";
        return false;
       } else {
        return true;
       }

  
}

function checkFormStep3() {
    var msg="<ul>";
    var t=0;
    
    if((!document.getElementById("infoPr-1").checked)&&(!document.getElementById("infoPr-2").checked) ) {
        var t=1;
        document.getElementById("fieldProp").className = "rf-fieldset rf-fieldset--inline rf-fieldset--error";
        msg = msg+'<li>Préciser si vous avez prévenu le propriétaire ou non.</li>';
    }

    if((!document.getElementById("log-1").checked)&&(!document.getElementById("log-2").checked) ) {
        var t=1;
        document.getElementById("fieldSoc").className = "rf-fieldset rf-fieldset--inline rf-fieldset--error";
        msg = msg+'<li>Préciser s\'il s\'agit d\'un logement social ou non.</li>';
    }

    if((!document.getElementById("Dlog-1").checked)&&(!document.getElementById("Dlog-2").checked) ) {
        var t=1;
        document.getElementById("departLogBloc").className = "rf-fieldset rf-fieldset--inline rf-fieldset--error";
        msg = msg+'<li>Préciser si vous avez déposé un préavis de départ du logement ou non.</li>';
    }

    if(ckMail(document.getElementById("mail").value)==false) {
        var t=1;
        document.getElementById("mail").className = "rf-input rf-input--error"
        msg = msg+'<li>Renseigner correctement votre adresse courriel.</li>';
    }


    const str3=document.getElementById("nom").value;
    if(str3=="" || str3.length < 2 ) {
        t=1;
        document.getElementById("nom").className = "rf-input rf-input--error"
        msg = msg+'<li>Renseigner votre nom.</li>';
    }


    
    if(ckCP(document.getElementById("cp").value)==false) {
        var t=1;
        document.getElementById("cp").className = "rf-input rf-input--error"
        msg = msg+'<li>Renseigner correctement votre code postal.</li>';
    }
    
    if(document.getElementById("libAd").value=="") {
        var t=1;
        document.getElementById("libAd").className = "rf-input rf-input--error"
        msg = msg+'<li>Renseigner correctement votre libellé d\'adresse.</li>';
    }

    if(document.getElementById("ville").value=="") {
        var t=1;
        document.getElementById("ville").className = "rf-input rf-input--error"
        msg = msg+'<li>Renseigner correctement votre ville.</li>';
    }

    
    if(t==1) {
        var affErr = document.getElementById('errInfosDesc');
        affErr.innerHTML = msg+'</ul>';
        document.getElementById("errInfos").style.display = "block";
        return false;
    } else {
        return true;
    }
}

function checkFormStep4() {
    if(document.getElementById("CGU").checked == false ) {
        document.getElementById("errCgu").style.display = "block";
        return false;
       } else {
        return true;
       }

  
}

$("#contactSend").bind("click", (function () {
    var t = 0;
    var msg='';
   
    const str3=document.getElementById("txtName").value;
    if(str3=="" || str3.length < 3 ) {
        t=1;
        msg = msg+'<li>Renseigner votre nom .</li>';
    }
    if(ckMail(document.getElementById("txtEmail").value)==false) {
        var t=1;
        msg = msg+'<li>Renseigner correctement votre adresse courriel.</li>';
    }
    
    const str4=document.getElementById("txtMsg").value;
    if(str4=="" || str4.length < 5 ) {
        t=1;
        msg = msg+'<li>Renseigner correctement votre message.</li>';
    }
    if(t==1) {
        
        document.getElementById("infoErrMsg").innerHTML = 'Merci de <ul>'+msg+'</ul>';
        document.getElementById("errMsg").style.display = "block";

        return false;
    } else {
        document.getElementById('contact').submit();
    }
    
    }));

function countCheckedJQuery(){
    var checked = $(".groupcheckbox:checked");
    var checked2 = $("input:checkbox:checked");
    return checked.length;
}



function chSitOn(element, img) {
    element.setAttribute('src', 'images/'+img+'_on.png');
}
function chSitOff(element, img) {
    element.setAttribute('src', 'images/'+img+'_off.png');
}

function chAff(id) {
    if(document.getElementById(id).style.display=='none') { document.getElementById(id).style.display = "block";
} else {
   document.getElementById(id).style.display = "none";
}
}

function changeImage(element1, element2, element3, idCriticite, critere)
{
 if(document.forms["signale"].elements.namedItem(critere).value==0) {
    document.forms["signale"].elements.namedItem(critere).value = idCriticite;
 } else {
    document.forms["signale"].elements.namedItem(critere).value = 0;
 }

  // alert('value='+ document.forms["signale"].elements.namedItem(critere).value);

    var x = document.getElementById(element1);
    var y = document.getElementById(element2);
    var a = document.getElementById(element3);

  var v = x.getAttribute("src");
  var w = y.getAttribute("src");
  var z = a.getAttribute("src");

  if(v == "images/s2_off.png"){
      v = "images/s2.png";
      w = "images/s4_off.png";
      z = "images/s5_off.png";
  }
  else {
      if(v == "images/s2.png") {

       v = "images/s2_off.png";
      }
  }

  if(v == "images/s4_off.png") {
      v = "images/s4.png";
      w = "images/s2_off.png";
      z = "images/s5_off.png";
  }
  else {
      if(v == "images/s4.png") {
          v = "images/s4_off.png";
      }
  }

  if(v == "images/s5_off.png") {
    z = "images/s4_off.png";
    w = "images/s2_off.png";
    v = "images/s5.png";
}
else {
    if(v == "images/s5.png") {
        v = "images/s5_off.png";
    }
}

  x.setAttribute("src", v);
  y.setAttribute("src", w);
  a.setAttribute("src", z);
}


function maj() {

    var xf=0; var critS=''; var proprio=''; var adults=''; var enf=''; social=''; var coords=''; var descrip=''; var adr=''; var photos=''; var preavis='';
    var divRecap = document.getElementById('recap');
    divRecap.innerHTML ='';

    var tab = document.getElementsByTagName("input");
	  for (var i = 0; i < tab.length; i++) {
		    if (tab[i].type == "checkbox" && tab[i].checked) {
			   critS +='<br>'+tab[i].id;
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='oui' && tab[i].id=='infoPr-1') {
			    proprio ='Vous avez prévenu votre propriétaire.';
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='non' && tab[i].id=='infoPr-2') {
			    proprio ='Vous n\'avez pas encore prévenu votre propriétaire.';
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='oui' && tab[i].id=='log-1') {
                social ='Il s\'agit d\'un logement social.';
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='oui' && tab[i].id=='Dlog-1') {
            preavis ='Vous avez déposé un préavis de départ.';
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='oui' && tab[i].id=='Dlog-2') {
            preavis ='Vous n\'avez pas déposé un préavis de départ.';
        }

        if (tab[i].type == "file" && tab[i].value!='') xf+=1;
    }
     descrip = document.getElementById('desc').value;
    if (xf>0) {
      photos ='Vous allez transmettre <b>'+ xf +' photo(s)</b>.'
    }

    if (document.getElementById('nbAdults').value != 't') adults = document.getElementById('nbAdults').value + ' adulte(s)';
    if (document.getElementById('nbEnfants').value != '0') enf = document.getElementById('nbEnfants').value + ' enfant(s)';
    
    if (document.getElementById('nom').value != '') coords = coords +  document.getElementById('nom').value.toUpperCase();
    if (document.getElementById('prenom').value != '') coords = coords + ' ' + document.getElementById('prenom').value.toUpperCase();
    if (document.getElementById('mail').value != '') coords = coords + ' (' + document.getElementById('mail').value;
    if (document.getElementById('phone').value != '') coords = coords + ' ' + document.getElementById('phone').value+')';
    if (document.getElementById('phone').value == '') coords = coords + ' - Pas de téléphone)';
    if (document.getElementById('num').value != '') adr = adr + document.getElementById('num').value;
    if (document.getElementById('libAd').value != '') adr = adr + ' ' + document.getElementById('libAd').value;
    if (document.getElementById('etage').value != '') adr = adr + ' ' + document.getElementById('etage').value;
    if (document.getElementById('numApt').value != '') adr = adr + ' '  + document.getElementById('numApt').value;
    if (document.getElementById('cp').value != '') adr = adr + ' ' + document.getElementById('cp').value;
    if (document.getElementById('ville').value != '') adr = adr + ' ' + document.getElementById('ville').value;




    var aff='<p>Synthèse de votre signalement : <br> <ul>';
    if(coords!='') aff += '<li><b>Vos coordonnées :</b> ' + coords +'</li>';
    if(adr !=  '') aff += '<li><b>Votre adresse : </b>' + adr + '</li>';
    if(proprio !=  '') aff += '<li>' + proprio + '</li>';
    if(adults !=  '') aff += '<li><b>Occupants :</b> ' + adults + '/' + enf + '</li>';
    if(social !=  '') aff += '<li>'+social+'</li>';
    if(preavis !=  '') aff += '<li>'+preavis+'</li>';
    aff += '<i>Modifier ces informations</i> <a href="javascript:goStep3();"><span class="rf-fi-edit-fill"></span></a>';
    
    if(critS !=  '') aff += '<li><b>Vous allez signaler des problèmes concernant : </b>' + critS + '</li>';
    if(descrip !=  '') aff += '<li><b>Description :</b> ' + descrip + '</li>';
    if(photos !=  '') aff += '<li>' + photos + '</li>';
    aff += '<i>Modifier ces informations</i> <a href="javascript:goStep1();"><span class="rf-fi-edit-fill"></span></a>';

   
  

    aff += '</ul><br>';

    divRecap.innerHTML = aff;
   

   }

function ckMail(mail) { var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i'); 
    if(reg.test(mail)) { 
        return(true); } 
    else { 
        return(false); }
}

function ckCP(cp) {
    var reg = new RegExp('^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$','i'); 
    if(reg.test(cp)) { return(true); } else { return(false); }
}

function goStep3() {
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").style.display = "none"; 
    document.getElementById("step3").style.display = "block";
    document.getElementById("step4").style.display = "none";
}
function goStep1() {
    document.getElementById("step1").style.display = "block";
    document.getElementById("step2").style.display = "none"; 
    document.getElementById("step3").style.display = "none";
    document.getElementById("step4").style.display = "none";
}

$("#s11").bind("click", (function () {
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";   
}));
$("#s12").bind("click", (function () {
        document.getElementById("step1").style.display = "block";
        document.getElementById("step3").style.display = "none";
}));
$("#s13").bind("click", (function () {
    document.getElementById("step1").style.display = "block";
    document.getElementById("step4").style.display = "none";
}));
$("#s21").bind("click", (function () {
    document.getElementById("step2").style.display = "block";
    document.getElementById("step3").style.display = "none";
}));
$("#s22").bind("click", (function () {
    document.getElementById("step2").style.display = "block";
    document.getElementById("step4").style.display = "none";
}));
$("#s31").bind("click", (function () {
    document.getElementById("step3").style.display = "block";
    document.getElementById("step4").style.display = "none";
}));

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
            document.getElementById("detAlert").style.display = "none";
            document.getElementById("errInfoProp").style.display = "none";
            document.getElementById("text_certifOK").style.display = "block";
    } else {
        document.getElementById("errInfoProp").style.display = "block";
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
    document.getElementById("modeAlim").style.display = "none";
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
    document.getElementById("modeAlim").style.display = "block";
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




