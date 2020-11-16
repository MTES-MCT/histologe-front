<?php

class etat_form {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }


    
public function getListMailARToSend()
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM `HSignalement_` WHERE `envoiMail` = 1
                   ;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 

    
public function checkMailAR()
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM HSignalement_ where ar=1
                   ;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 




public function getListSituations()
     /* tableau 
     * Créée le : 
     * Par : AST
     * Params : 
     * Modifs : 
     */
    {
		 try {
		 	$sql = "SELECT * FROM HSituation_pb2 where actif = 1 order by ordrePresentation;";
            $select = $this->con->prepare($sql);
			
			$select->execute();
            $quest = $select->fetchAll(PDO::FETCH_OBJ);
          	  
        } catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
            throw $e;
        }  
        
        return $quest;
        
    } 

    
public function getSignByKeyRelance($key)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM HSignalement_ where relanceKey='$key';";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }  
       
       return $quest;
       
   } 

public function getSignById($idSign)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM HSignalement_ where idSignalement='$idSign';";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }  
       
       return $quest;
       
   } 

   public function getUserBoById($idUser)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT * FROM HUsers_BO where id_userbo=$idUser;";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }  
      
      return $quest;
      
  }  


public function checkInfosNewSignKO()
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM `HSignalement_` WHERE envoiMail=0 and `proprio_info`='n' and `nbreRelances` <=10 and `dateRelance` < DATE_SUB(now(), INTERVAL 7 DAY);";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }  
       
       return $quest;
       
   } 

   

   public function checkInfosNewSignME()
   /* tableau 
   * Créée le : 
   * Par : AST : récupère liste des signalements nécessitants la source energétique du logement
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT * FROM `HSignalement_` S, HSignalement_HCritere SC
           where S.idSignalement = SC.idSignalement
           and SC.idCritere in (65,55,56,68,69,70,76)
           and S.envoiMail=0
           and `nbreRelances` <=10 and `dateRelance` < DATE_SUB(now(), INTERVAL 7 DAY);";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }  
      
      return $quest;
      
  } 

public function checkInfosNewSignOK()
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           //test info energie needed ! 
           $sql = "SELECT * FROM `HSignalement_` WHERE envoiMail=0 and `proprio_info`='o';";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }  
      
      $x=0; 
      
      foreach($quest as $key){
        try{ 
       
            $sql ="update HSignalement_ set etat=1, envoiMail=1, dtModifSignalement=now() where idSignalement='".$quest[$x]->idSignalement."';";
            $data_form3 = $this->con->prepare($sql);
            $data_form3->execute();
           
            } catch (Exception $ex) {
                    echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                    error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                    throw $ex;
                            
            }
            $x++;
      }
      
  } 
    
 public function getCriteres($situationid)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT * FROM HCritere2 where idSituation_pb=".$situationid."
                   ;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 
   
   public function getCriticites($critereid)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT * FROM HCriticite where idCritere=".$critereid." order by ordreCriticite;";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }
      
      return $quest;
      
  } 


 
  // ($mail,  $tel, $type, $numAd, $libAd, $cpAd, $ville, $etage, $apt, $infoProprio, $description, $cgu, $adults, $enfants, $nom, $prenom, $surface)
 	
public function setSignalement($mail,  $tel, $type, $numAd, $libAd, $cpAd, $ville, $etage, $apt, $infoProprio, $description, $cgu, $adults, $enfants, $nom, $prenom, $surface, $logSoc) {
     /* tableau 
    * Créée le : 06/03/20
    * Par : AST
    * Params : infos pour création signalement sauf criteres
    * Renvoi id du signalement créée 
    * Modifs : ajout valeur 1 pour envoi accusé réception (1 : à envoyer, 2 envoyé)
    ajout etat = 1 : nouveau 
    */  
        
    try{
       
        $sql = "insert into HSignalement_ (idSignalement, courriel, dtCreaSignalement, telephone, description, proprio_info, cgu, ar, etat, OccupantsAdultes, 
        OccupantsEnfants, nomSign, prenomSign, surface, envoiMail, relanceKey, logSoc) 
	    values (:t_id, :t_mail, now(), :t_tel, :t_desc, :t_proprio, :t_cgu, 1, 0, :t_adults, :t_enfants, :t_nom, :t_prenom, :t_surface, 0, :t_relanceKey, :t_logSoc)
        ";
        $data_form = $this->con->prepare($sql);
        
        $id=$this->genererCa(25);
        $keyR=$this->genererCa(30);

        $data_form->bindValue('t_id', $id, PDO::PARAM_STR);
		$data_form->bindValue('t_mail', $mail, PDO::PARAM_STR);
		$data_form->bindValue('t_tel', $tel, PDO::PARAM_STR);
		$data_form->bindValue('t_desc', $description, PDO::PARAM_STR);
        $data_form->bindValue('t_proprio', $infoProprio, PDO::PARAM_STR);
        $data_form->bindValue('t_cgu', $cgu, PDO::PARAM_STR);
        $data_form->bindValue('t_adults', $adults, PDO::PARAM_STR);
        $data_form->bindValue('t_enfants', $enfants, PDO::PARAM_STR);
        $data_form->bindValue('t_nom', $nom, PDO::PARAM_STR);
        $data_form->bindValue('t_prenom', $prenom, PDO::PARAM_STR);
        $data_form->bindValue('t_surface', $surface, PDO::PARAM_STR);
        $data_form->bindValue('t_relanceKey', $keyR, PDO::PARAM_STR);
        $data_form->bindValue('t_logSoc', $logSoc, PDO::PARAM_STR);
    
      //  $data_form->beginTransaction();			
		    $data_form->execute();
       // $data_form->commit();
        $signId =$id;

        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
    
    	

    try{
       
	    $sql = "insert into HAdresse_ (numeroRue, nomRue, codepostal, ville, etage, numLog) 
	    values (:t_num, :t_nom, :t_cp, :t_ville, :t_etage, :t_numlog) ";
        $data_form2 = $this->con->prepare($sql);
        

		$data_form2->bindValue('t_num', $numAd, PDO::PARAM_STR);
		$data_form2->bindValue('t_nom', $libAd, PDO::PARAM_STR);
		$data_form2->bindValue('t_cp', $cpAd, PDO::PARAM_STR);
        $data_form2->bindValue('t_ville', $ville, PDO::PARAM_STR);
        $data_form2->bindValue('t_etage', $etage, PDO::PARAM_STR);
        $data_form2->bindValue('t_numlog', $apt, PDO::PARAM_STR);
        
	//	$data_form2->beginTransaction();			
		    $data_form2->execute();
    //    $data_form2->commit();
        $adId = $this->con->lastInsertId();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
    
        try {
            $sql = "SELECT max(refSign)+1 as maxRef from HSignalement_;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest1 = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }	
    
   
    try{
       
	    $sql = "update HSignalement_ set idAdresse = $adId, refSign=".$quest1[0]->maxRef." where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
    
        return $signId;
    }	
 

public function updateARSign($signId, $val) {

    try{ 
       
	    $sql = "update HSignalement_ set ar = $val, envoiMail=$val, dtModifSignalement=now()  where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}



public function updateSignAttInfos($signId) {

    try{ 
       
	    $sql = "update HSignalement_ set dtModifSignalement=now(), dateRelance=now(), nbreRelances=nbreRelances+1  where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}


public function updateSignalement($col, $signId, $value, $modeInfoProp='', $dtInfo='') {
    if($modeInfoProp != '') {
        $sql = "update HSignalement_ set dtModifSignalement=now(), ".$col."='".$value."', modeInfoProprio='".$modeInfoProp."', dtInfoProprio='$dtInfo'
         where idSignalement = '$signId';  ";
    } else {
        $sql = "update HSignalement_ set dtModifSignalement=now(), ".$col."='".$value."' 
        where idSignalement = '$signId';  ";
    }
    //$this->traceSql($sql,'updateSignVisit');

    try{ 
       
        
        $data_form3 = $this->con->prepare($sql);
        $data_form3->execute();
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}



public function insertUserActivity($user, $step, $etat, $nav) {

    try{
       
	    $sql = "insert into Htrace (idSession, step, etat, navigateur, stepDate) 
	    values (:t_user, :t_step, :t_etat, :t_nav, now()) ";
        $data_form2 = $this->con->prepare($sql);
    
		$data_form2->bindValue('t_user', $user, PDO::PARAM_STR);
        $data_form2->bindValue('t_step', $step, PDO::PARAM_STR);
        $data_form2->bindValue('t_etat', $etat, PDO::PARAM_STR);
        $data_form2->bindValue('t_nav', $nav, PDO::PARAM_STR);

        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }


public function addPhotoSign($sign, $namePhoto) {

    try{
       
	    $sql = "insert into HPhoto (titreFichier, dtCreaFichier, idSignalement) 
	    values (:t_nom, now(), :t_sign) ";
        $data_form2 = $this->con->prepare($sql);
    
		$data_form2->bindValue('t_nom', $namePhoto, PDO::PARAM_STR);
		$data_form2->bindValue('t_sign', $sign, PDO::PARAM_STR);
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }

public function addSuivi($idSign,$com,$user,$ipSce, $visi,$idPart=0) {

    try{
       
        $sql = "insert into HSuivi (idSignalement, user, dtSuivi, ipsuivi, descSuivi, avisUser, idPartenaire) 
	    values (:t_idSign, :t_user, now(), :t_ip, :t_com, :t_visu, :t_part) ";
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_idSign', $idSign, PDO::PARAM_STR);
        $data_form2->bindValue('t_user', $user, PDO::PARAM_STR);
        $data_form2->bindValue('t_ip', $ipSce, PDO::PARAM_STR);
        $data_form2->bindValue('t_com', $com, PDO::PARAM_STR);
        $data_form2->bindValue('t_visu', $visi, PDO::PARAM_STR);
        $data_form2->bindValue('t_part', $idPart, PDO::PARAM_STR);
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }  

  public function addRdv($idSign,$dateRdv,$heureRdv,$userBO=3) {

    try{
       
        $sql = "insert into HRdvVisit (idSignalement, dateVisit, heureVisit, creaVisit, etatVisit, userBoVisit) 
        values (:t_idSign, :t_date, :t_heure, now(), 0, :t_user) ";
       // $this->traceSql($idSign.'-'.$dateRdv.'-'.$heureRdv, 'addRdv');
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_idSign', $idSign, PDO::PARAM_STR);
        $data_form2->bindValue('t_date', $dateRdv, PDO::PARAM_STR);
        $data_form2->bindValue('t_heure', $heureRdv, PDO::PARAM_STR);
        $data_form2->bindValue('t_user', $userBO, PDO::PARAM_STR);
       
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }  
   
public function addTraceMail($source, $dest, $exped, $cause, $idValue) {

    try{
       
        $sql = "insert into HTraceMail (sourceEnvoi, destinataire, expediteur, cause, dateEnvoi, idValue) 
	    values (:t_source, :t_dest, :t_exped, :t_cause, now(), :t_idValue) ";
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_source', $source, PDO::PARAM_STR);
        $data_form2->bindValue('t_dest', $dest, PDO::PARAM_STR);
        $data_form2->bindValue('t_exped', $exped, PDO::PARAM_STR);
        $data_form2->bindValue('t_cause', $cause, PDO::PARAM_STR);
        $data_form2->bindValue('t_idValue', $idValue, PDO::PARAM_STR);
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }    
   

public function addHoney() {
    $stock='';
    try{
       
        $indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;

foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        $stock = $stock.'|'.$arg.' - ' . $_SERVER[$arg] . '|<br>' ;
    }
    else {
        $stock = $stock.'|'.$arg. '|<br>' ;
    }
}



        $sql = "insert into HHoneyPot (HoneyValues, date) values (:t_stock, now()) ";
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_stock', $stock, PDO::PARAM_STR);
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }  

public function  setCritereSignalement($idCrit, $criti, $idSign)   {
        /* tableau 
       * Créée le : 06/03/20
       * Par : AST
       * Params : id d'un critere lié à un signalement
       * 
       * Modifs : 
       */  
           
       try{
          
           $sql = "insert into HSignalement_HCritere (idSignalement, idCritere, idCriticite, dtCrea) 
           values (:t_sign, :t_crit, :t_criti, now()) ";
           $data_form = $this->con->prepare($sql);
           $data_form->bindValue('t_crit', $idCrit, PDO::PARAM_STR);
           $data_form->bindValue('t_sign', $idSign, PDO::PARAM_STR);
           $data_form->bindValue('t_criti', $criti, PDO::PARAM_STR);
           $data_form->execute();
          
           } catch (Exception $ex) {
                   echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."->".$idCrit."-".$criti."-".$idSign."\n";
                   error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                   throw $ex;
                           
           }

        }

public function genererCa($longueur, $listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        {
         $chaine = '';
         $max = mb_strlen($listeCar, '8bit') - 1;
         for ($i = 0; $i < $longueur; ++$i) {
         $chaine .= $listeCar[random_int(0, $max)];
         }
         return $chaine;
        }



public function traceSql($sql_s, $func) {
            try{
                
                $sql = "insert into HTraceSql (sqlSend, fonction, dtCall) 
                values (:t_sql, :t_func, now())
                ";
                $data_form = $this->con->prepare($sql);
                $data_form->bindValue('t_sql', $sql_s, PDO::PARAM_STR);
                $data_form->bindValue('t_func', $func, PDO::PARAM_STR);
               
            //  $data_form->beginTransaction();			
                    $data_form->execute();
            // $data_form->commit();
                } catch (Exception $ex) {
                        echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                        error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                        throw $ex;
                                
                }
    }


    	
}

