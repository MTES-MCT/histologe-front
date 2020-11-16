<?php 
//ini_set('display_errors',1);
session_start();

require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');


// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);
/*
foreach($_POST as $key=>$value){
    echo "Nom du champ : ".$key." ; Valeur :".$value."<br/>";
}
*/
$x=0; $p=0; $z=0;
 $cgu='?';
 $adults=0; $enfants=0; $prenom=''; $surface=0;
 $etage=0; $apt='';
foreach($_POST as $key=>$value){
    //echo "Nom du champ : ".$key." ; Valeur :".$value."<br/>";
  
   
    //info signalement
    if($key=='mail') $mail=$value;
    if($key=='phone') $tel=$value;
    if($key=='typeH') $type=$value;
    if($key=='numero') $numAd=$value;
    if($key=='libAd') $libAd=$value;
    if($key=='cp') $cpAd=$value;
    if($key=='ville') $ville=$value;
    if($key=='infoPr') $infoProprio=$value;
    if($key=='CGU') $cgu=$value;
    if($key=='nbAdults') $adults=$value;
    if($key=='nom') $nom=filtre($value);
    if($key=='prenom') $prenom=filtre($value);
    if($key=='surface') $surface=$value;
    if($key=='numApt') $apt=$value;
    if($key=='etage') $etage=$value;
    if($key=='logSoc') $social=$value;

  

     


     // A filtrer 
     if($key=='desc') $description=filtre($value);
 
     //criteres 
     if(substr($key,0,2)=='c_') {
         $crit[$x]=substr($key,2,strlen($key));
         //echo 'CRIT'.$crit[$x];
         $x++;
     }
   
     if(substr($key,0,9)=='criticite') {
        if($value!='0') {
          $criticite[$z]->idCritere = substr($key,9,strlen($key));  
          $criticite[$z]->id = $value;
         
         $z++;
        }
    }


 } // fin POST

 //Vérif champs : mail, description, signalement, cp, libad, ville, cgu
 if (check_mail_address($mail) == FALSE) {$p='mail'; }
 if(count($crit)<1)  {$p = $p.' - crit'; }
 if (!preg_match("^([0-9]{5})$^", $cpAd)) {$p=$p.' - cp'; }
 if(strlen($libAd) < 3) {$p.=' - lib'; }
 if(strlen($ville) <= 2) {$p.=' - ville'; }
 if($cgu != 'on') {$p.=' - cgu'; }

if($p!=0) {
  //  header("Location: signEt1.php");
   // exit();
   echo "erreurs détectée : ".$p;
}

 //création signalement
// echo $mail.'-'.$tel.'-'.$type.'-'.$numAd.'-'.$libAd.'-'.$cpAd.'-'.$ville.'-'.$etage.'-'.$apt.'-'.$infoProprio.'-'.$description.'-'.$cgu.'-'.$adults.'-'.$enfants.'-'.$nom.'-'.$prenom.'-'.$surface;


 $sign = $infosForm->setSignalement($mail,  $tel, $type, $numAd, $libAd, $cpAd, $ville, $etage, $apt, $infoProprio, $description, $cgu, $adults, $enfants, $nom, $prenom, $surface, $social);



//Ajout critères de ce signalement
$x=0;
foreach ($crit as $key) {
   // echo $crit[$x].' pour '.$sign;
   $z=0; $criti=0; $critiMin='';
   foreach ($criticite as $key) {
        
        if($criticite[$z]->idCritere == $crit[$x]) {
            $criti = $criticite[$z]->id;
        } 
        $z++; 
   }
   //si pas de criticite : intègre valeur min par défaut
   if($criti==0) {
       $critiMin = $infosForm->getCriticites($crit[$x]);
       $criti=$critiMin[0]->idCriticite;
   }

   $infosForm->setCritereSignalement($crit[$x], $criti, $sign);
   $x++;
}

$y=0;
 foreach($_FILES as $key=>$value){
     //   echo 'file : '.$key.' value : '.$value;
                $y++;
                $content_dir = '/home/histolc/www/_upload/'; 

                //tester nom fichier attendu

            if($_FILES['file'.$y]['tmp_name']!='') {
                $tmp_file = $_FILES['file'.$y]['tmp_name'];

                //echo $tmp_file.'-';

                if( !is_uploaded_file($tmp_file) )
                {
                    exit("Le fichier est introuvable");
                }

                // check extension
                $type_file = $_FILES['file'.$y]['type'];

                if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
                {
                    exit("Le fichier n'est pas une image");
                }

                // rename, update et copie 
                $name_file = $sign.$y.'.'.str_replace('image/','',$type_file);
                $infosForm->addPhotoSign($sign,$name_file);
                
                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                {
                    exit("Impossible de copier le fichier dans $content_dir");
                }
            }
 }




    //Affichage résultats
    $_SESSION['sign_valid'] = 'ok';
    header("Location:Signalement");




   // sendSignalement($mail); champ envoiMail=1 dans db : envoi à faire 

//functions 

 function filtre($lib) {
     $val=str_replace('\'', ' ', $lib);
     $val=str_replace('"',' ',$val);
     $val = str_replace(
        array('select', 'insert', 'update'), '*', $val);
     $val = str_replace(
         array( '\\',    "\0",   "'",    "\x8" , "\n",   "\r",   "\t",   "\x1A" ),
          array( '\\\\',  '\\0',  '\\\'', '\\b',          '\\n',  '\\r',  '\\t',  '\\Z' ),
        $val);
    $val = filter_var ( $val, FILTER_SANITIZE_STRING);

    return $val;

 }

 function check_mail_address($email)
{
    if (@!preg_match("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        return false;
    }
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (@!preg_match("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (@!preg_match("^\[?[0-9\.]+\]?$", $email_array[1])) {
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false;
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (@!preg_match("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}


 
