
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

  if(v == "img/s2_off.png"){
      v = "img/s2.png";
      w = "img/s4_off.png";
      z = "img/s5_off.png";
  }
  else {
      if(v == "img/s2.png") {

       v = "img/s2_off.png";
      }
  }

  if(v == "img/s4_off.png") {
      v = "img/s4.png";
      w = "img/s2_off.png";
      z = "img/s5_off.png";
  }
  else {
      if(v == "img/s4.png") {
          v = "img/s4_off.png";
      }
  }

  if(v == "img/s5_off.png") {
    z = "img/s4_off.png";
    w = "img/s2_off.png";
    v = "img/s5.png";
}
else {
    if(v == "img/s5.png") {
        v = "img/s5_off.png";
    }
}

  x.setAttribute("src", v);
  y.setAttribute("src", w);
  a.setAttribute("src", z);
}




function chAff(id) {
     if(document.getElementById(id).style.display=='none') { document.getElementById(id).style.display = "block";
} else {
    document.getElementById(id).style.display = "none";
}

}

$("#vol_o").bind("click", (function () {
    document.getElementById('filtre').style.display='block';
}));
$("#vol_f").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));

$("#titsit0").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit1").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit2").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit3").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit4").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit5").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsit10").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));


$("#titsitimg0").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsitimg1").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsitimg2").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsitimg3").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsitimg4").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));
$("#titsitimg5").bind("click", (function () {
    document.getElementById('filtre').style.display='none';
}));

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
    }
}));
$("#stepnext2sm").bind("click", (function () {
    var datastring = 'step=1&etat=beforesm';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    var valid=checkFormStep1();
   if (valid==true) {
    var datastring = 'step=1&etat=aftersm';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
       document.getElementById("step1").style.display = "none";
       document.getElementById("step2").style.display = "block";
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
    var datastring = 'step=2&etat=after';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    if (valid==true) {
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").style.display = "block";
    maj();
    }

}));
$("#stepnext3sm").bind("click", (function () {
    var datastring = 'step=2&etat=beforesm';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    var valid=checkFormStep2();
    if (valid==true) {
        var datastring = 'step=2&etat=aftersm';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").style.display = "block";
    maj();
    }

}));


$("#stepnext4").bind("click", (function () {
    var datastring = 'step=3&etat=before';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    $t=checkForm();
    if($t==true) {
        var datastring = 'step=3&etat=after';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
        document.getElementById('signale').submit();
        document.getElementById('wait').style.display = "block";
        document.getElementById("stepnext4").style.display = "none";

    }
}));

$("#stepnext4sm").bind("click", (function () {
    var datastring = 'step=3&etat=beforesm';
    $.ajax({
        type: "POST",
        url:"updateUsage.php",
        data:datastring      
    });
    $t=checkForm();
    if($t==true) {
        var datastring = 'step=3&etat=aftersm';
        $.ajax({
            type: "POST",
            url:"updateUsage.php",
            data:datastring      
        });
        document.getElementById('signale').submit();
        document.getElementById("waitsm").style.display = "block";
        document.getElementById("stepnext4sm").style.display = "none";

    }
}));


$("#step_2").bind("click", (function () {
    var valid=checkFormStep1();
    if (valid==true) {
        document.getElementById("step2").style.display = "block";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step1").style.display = "none";
    }

}));

$("#step_23").bind("click", (function () {
    document.getElementById("step2").style.display = "block";
    document.getElementById("step3").style.display = "none";
    document.getElementById("step1").style.display = "none";


}));

$("#step_1").bind("click", (function () {
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").style.display = "none";
    document.getElementById("step1").style.display = "block";


}));
$("#step_13").bind("click", (function () {
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").style.display = "none";
    document.getElementById("step1").style.display = "block";


}));
$("#step_12").bind("click", (function () {

        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step1").style.display = "block";


}));

$("#step_3").bind("click", (function () {
    var valid=checkFormStep1();
    if (valid==true) {
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "block";
        document.getElementById("step1").style.display = "none";
        maj();
    }

}));

$("#step_32").bind("click", (function () {
    var valid=checkFormStep2();
    if (valid==true) {
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "block";
        document.getElementById("step1").style.display = "none";
        maj();
    }

}));


$("#photo").bind("click", (function () {
	document.getElementById("morephoto").style.display = "block";

}));

$("#restric").bind("click", (function () {
	document.getElementById("resticView").style.display = "block";

}));


function maj() {

    var xf=0; var critS=''; var proprio=''; var adults=''; var enf=''; social=''; var coords=''; var descrip=''; var adr=''; var photos='';
    var divRecap = document. getElementById('recap');
    divRecap.innerHTML ='';

    var tab = document.getElementsByTagName("input");
	  for (var i = 0; i < tab.length; i++) {
		    if (tab[i].type == "checkbox" && tab[i].checked) {
			   critS +='<br>'+tab[i].id;
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='oui' && tab[i].id=='plan-1') {
			    proprio ='Vous avez prévenu votre propriétaire.';
        }
        if (tab[i].type == "radio" && tab[i].checked && tab[i].value=='non' && tab[i].id=='plan-2') {
			    proprio ='Vous n\'avez pas encore prévenu votre propriétaire.';
        }

      
    


        if (tab[i].type == "file" && tab[i].value!='') xf+=1;
    }
     descrip = document.getElementById('desc').value;
    if (xf>0) {
      photos ='Vous allez transmettre '+ xf +' photo(s).'
    }

    if (document.getElementById('nbAdults').value != 't') adults = document.getElementById('nbAdults').value + ' adulte(s)';
    if (document.getElementById('nbEnfants').value != '0') enf = document.getElementById('nbEnfants').value + ' enfant(s)';
    
    if (document.getElementById('nom').value != '') coords = coords +  document.getElementById('nom').value.toUpperCase();
    if (document.getElementById('prenom').value != '') coords = coords + ' ' + document.getElementById('prenom').value.toUpperCase();
    if (document.getElementById('mail').value != '') coords = coords + ' (' + document.getElementById('mail').value;
    if (document.getElementById('phone').value != '') coords = coords + ' ' + document.getElementById('phone').value+')';
    if (document.getElementById('num').value != '') adr = adr + document.getElementById('num').value;
    if (document.getElementById('libAd').value != '') adr = adr + ' ' + document.getElementById('libAd').value;
    if (document.getElementById('etage').value != '') adr = adr + ' ' + document.getElementById('etage').value;
    if (document.getElementById('numApt').value != '') adr = adr + ' '  + document.getElementById('numApt').value;
    if (document.getElementById('cp').value != '') adr = adr + ' ' + document.getElementById('cp').value;
    if (document.getElementById('ville').value != '') adr = adr + ' ' + document.getElementById('ville').value;




    var aff='<p>Synthèse de votre signalement : <br> <ul>';
    if(coords!='') aff += '<li>Vos coordonnées : ' + coords +'</li>';
    if(adr !=  '') aff += '<li>Votre adresse : ' + adr + '</li>';
   
    if(adults !=  '') aff += '<li>Occupants : ' + adults + '/' + enf + '</li>';
    if(critS !=  '') aff += '<li>Vous allez signaler des problèmes concernant : ' + critS + '</li>';
    if(descrip !=  '') aff += '<li>Description : ' + descrip + '</li>';
    if(proprio !=  '') aff += '<li>' + proprio + '</li>';
    if(photos !=  '') aff += '<li>' + photos + '</li></ul><br>';

    if(critS!='') divRecap.innerHTML = aff;

   }

   function chSitOn(element, img) {
        element.setAttribute('src', 'img/'+img+'_on.png');
    }
    function chSitOff(element, img) {
        element.setAttribute('src', 'img/'+img+'_off.png');
    }

    function agents(id){
        if(document.getElementById("menub_bis").style.display ==""){
          document.getElementById("menub_bis").style.display ="none";
          document.getElementById("menu").style.display ="";
        }
        else if(document.getElementById("menu").style.display ==""){
          document.getElementById("menub_bis").style.display ="";
          document.getElementById("menu").style.display ="none";

        }
    }
    function agents_2(id){
        if(document.getElementById("menub_bis_2").style.display ==""){
          document.getElementById("menub_bis_2").style.display ="none";
          document.getElementById("menu_2").style.display ="";
        }
        else if(document.getElementById("menu_2").style.display ==""){
          document.getElementById("menub_bis_2").style.display ="";
          document.getElementById("menu_2").style.display ="none";

        }
    }
