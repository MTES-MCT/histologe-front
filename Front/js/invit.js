$('#datepicker').datepicker({
    minDate: new Date(),
    beforeShowDay: $.datepicker.noWeekends,
    dateFormat: "DD dd-mm-yy",
    altField: "#datepicker",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    firstDay: 1 ,
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',

    orientation: "auto left"
});

$("#datepicker").bind("change", (function () {
/* var datastring = 'action=proprio&signId=' + '&dt='+document.getElementById('datepicker').value ;

$.ajax({
 type: "POST",
 url:"",
 data:datas,
 success: function(msg){
    $("#horaires").html(msg);
 },
 error: function(msg){
       alert('houpps : '+msg);
 }
});
*/  
document.getElementById('horaires').style.display = "block";

}
));    


$("#valid1").bind("click", (function () {
var info=''; var t=0;

if(document.getElementById('datepicker').value == '') {t=1;}

if (t == 0) {
var datastring = 'action=rdv&signId=' + document.getElementById('sign').value + '&heure='+document.getElementById('heure').value+'&dt='+document.getElementById('datepicker').value ;

//alert (datastring);
$.ajax({
type: "POST",
url:"updateSign.php",
data:datastring,
success: function(msg){
   window.location.href="_rdvValid.php";
},
error: function(msg){
   alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
}     
});

 
} else {
alert ('Merci de choisir une date.')
}

}
));   