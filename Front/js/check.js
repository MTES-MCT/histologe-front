		
	function checkContact() {
		var msg="";
			var t=0;
			if(ckMail(document.getElementById("txtEmail").value)==false) {
				var t=1;
				msg = msg+' . Renseigner correctement votre adresse courriel.\n';
			}
			const str1=document.getElementById("txtName").value;
			if(str1=="" || str1.length < 2 || str1=="Votre nom *" ) {
				t=1;
				msg = msg+' . Renseigner votre nom .\n';
			}
			const str2=document.getElementById("txtMsg").value;
			if(str2=="" || str2.length < 10 ) {
				t=1;
				msg = msg+' . Saisir un rapide message.\n';
			}
			if(t==1) {
				alert('Merci de corriger les points suivants : \n'+msg);
				return false;
			} else {
				return true; 
			}



	}
	
	
	function checkForm() {
			var msg="";
			var t=0;
			
			if(document.getElementById("CGU").checked == false){
				var t=1;
				msg = msg+' . Accepter les Conditions Générales d\'Utilisation.\n';
            }
            
          	if(t==1) {
				alert('Merci de corriger les points suivants : \n'+msg);
				return false;
			} else {
				return true;
			}
		}
	
		function ckMail(mail) { var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i'); 
			if(reg.test(mail)) { return(true); } else { return(false); }
		 }
	

		 function countCheckedJQuery(){
                var checked = $(".groupcheckbox:checked");//sélectionne tous les éléments de classe "groupcheckbox" qui sont sélectionné
                var checked2 = $("input:checkbox:checked");//pareil mais avec toutes les checkbox de la page
                return checked.length;
			}

		function ckCP(cp) {
			var reg = new RegExp('^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$','i'); 
			if(reg.test(cp)) { return(true); } else { return(false); }
		}


function checkFormStep1() {
			var msg="";
			var t=0;
		

			if (countCheckedJQuery() < 1){
				t=1;
				msg = msg+' . Cocher au moins un type de signalement.\n';
                }
			
		
			if(t==1) {
				alert('Merci de corriger les points suivants : \n'+msg);
				return false;
			} else {
				return true;
			}
		}

function checkFormStep2() {
			var msg="";
			var t=0;
			
			if((!document.getElementById("plan-1").checked)&&(!document.getElementById("plan-2").checked) ) {
				var t=1;
				msg = msg+' . Préciser si vous avez prévenu le propriétaire ou non.\n';
			}

			if((!document.getElementById("log1").checked)&&(!document.getElementById("log2").checked) ) {
				var t=1;
				msg = msg+' . Préciser s\'il s\'agit d\'un logement social ou non.\n';
			}


			if(ckMail(document.getElementById("mail").value)==false) {
				var t=1;
				msg = msg+' . Renseigner correctement votre adresse courriel.\n';
			}

		
			const str3=document.getElementById("nom").value;
			if(str3=="" || str3.length < 2 ) {
				t=1;
				msg = msg+' . Renseigner votre nom .\n';
			}


			
			if(ckCP(document.getElementById("cp").value)==false) {
				var t=1;
				msg = msg+' . Renseigner correctement votre code postal.\n';
			}
			
			if(document.getElementById("libAd").value=="") {
				var t=1;
				msg = msg+' . Renseigner correctement votre libellé d\'adresse.\n';
			}

			if(document.getElementById("ville").value=="") {
				var t=1;
				msg = msg+' . Renseigner correctement votre ville.\n';
			}

			
			if(t==1) {
				alert('Merci de corriger les points suivants : \n'+msg);
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
			msg = msg+' . Renseigner votre nom .\n';
		}
		if(ckMail(document.getElementById("txtEmail").value)==false) {
			var t=1;
			msg = msg+' . Renseigner correctement votre adresse courriel.\n';
		}
		
		const str4=document.getElementById("txtMsg").value;
		if(str4=="" || str4.length < 5 ) {
			t=1;
			msg = msg+' . Renseigner correctement votre message .\n';
		}
		if(t==1) {
			alert('Merci de corriger les points suivants : \n'+msg);
			return false;
		} else {
			document.getElementById('contact').submit();
		}
		
		}));