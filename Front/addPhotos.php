<?php 
//ini_set('display_errors',1);
session_start();
if(isset($_POST['signId'])) {
    $sign = $_POST['signId'];
    $relanceKey= $_POST['k'];
} else {
    header("Location: https://histologe.beta.gouv.fr");  
    exit;
}




require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

date_default_timezone_set('Europe/Paris');


// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

$y=0;
 foreach($_FILES as $key=>$value){
     //   echo 'file : '.$key.' value : '.$value;
                $y++;
                $content_dir = '/home/histolc/www/dev/_upload/'; 

                //tester nom fichier attendu

            if($_FILES['file'.$y]['tmp_name']!='') {
                $tmp_file = $_FILES['file'.$y]['tmp_name'];

                //echo $tmp_file.'-';

                if( !is_uploaded_file($tmp_file) )
                {
                    header("Location:Complement?k=".$relanceKey.'&p=2');
                    exit("Le fichier est introuvable");
                }

                // check extension
                $type_file = $_FILES['file'.$y]['type'];

                if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
                {
                    header("Location:Complement?k=".$relanceKey.'&p=3');
                    exit("Le fichier n'est pas une image");
                }

                // rename, update et copie 
                $name_file = $sign.$y.'.'.str_replace('image/','',$type_file);
                $infosForm->addPhotoSign($sign, $name_file);
                
                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                {
                    header("Location:Complement?k=".$relanceKey.'&p=4');
                    exit("Impossible de copier le fichier dans $content_dir");
                }
            }
 }

 header("Location:Complement?k=".$relanceKey.'&p=1');



