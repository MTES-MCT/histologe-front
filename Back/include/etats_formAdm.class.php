<?php

class etat_formAdm {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }




public function getEtatByStep($etat, $step)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT etat, count(etat) as nb FROM `Htrace` where step=$step and etat like ('$etat%');";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           error_log("ERREUR  - getEtatByStep  !".$e->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
           throw $e;
       }
       
       return $quest;
       
   } 

public function getEtatSessions()
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT step, count(step) as nb FROM `Htrace` group by `step`;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           error_log("ERREUR  - getEtatSessions  !".$e->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
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

   
public function getCountSign()
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT etat, count(*) as nb FROM `HSignalement_` group by etat;";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }
      
      return $quest;
      
  } 

public function getListNvxSign()
     /* tableau 
     * Créée le : 
     * Par : AST
     * Params : 
     * Modifs : 
     */
    {
		 try {
		 	$sql = "SELECT distinct HS.*, A.* FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A  
             WHERE 
             HS.idSignalement = SC.idSignalement and
             SC.idCritere = C.idcritere And
             C.idSituation_pb = S.idSituation_pb
             and HS.idAdresse = A.idAdresse
             and S.actif = 1
            order by HS.dtCreaSignalement desc";
            $select = $this->con->prepare($sql);
			
			$select->execute();
            $quest = $select->fetchAll(PDO::FETCH_OBJ);
          	  
        } catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
            throw $e;
        }
        
        return $quest;
        
    } 

    


public function getSignAdrById($id)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT S.*, A.*, date_format(S.dtCreaSignalement, '%d-%m-%Y %H:%i') as dtCreaSignalementF, date_format(S.dtPriseEnCharge, '%d-%m-%Y %H:%i') as dtPriseEnChargeF FROM HSignalement_ S, HAdresse_ A
            where S.idAdresse = A.idAdresse
            and S.idSignalement='".$id."';";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 

public function getCriticiteSignById($idSign, $idCriticite)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT CI.* FROM HSignalement_HCritere HC, HCriticite CI
            where  CI.idCriticite = HC.idCriticite
            and HC.idSignalement='$idSign'
            and HC.idCriticite = $idCriticite
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
   public function getCritSignById($id)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $sql = "SELECT HC.*, C.*, S.libSituation FROM HSignalement_HCritere HC, HCritere2 C, HSituation_pb2 S
            where HC.idCritere = C.idCritere
            and S.idSituation_pb = C.idSituation_pb
            and HC.idSignalement = '".$id."';";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 

   public function getSignPhotosById($id)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT * from HPhoto 
           where idSignalement = '".$id."';";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }
      
      return $quest;
      
  } 

  
  public function getListPartenaires()
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT * FROM HPartenaire;";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }
     
     return $quest;
     
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
 
   
   public function getlistSuiviBySign($idSign)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT *, date_format(dtSuivi, '%d-%m-%Y %H:%i') as dtSuiviF FROM HSuivi where idSignalement='".$idSign."' order by dtSuivi desc;";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }
      
      return $quest;
      
  } 
 
  public function getPartById($idPart)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT P.* FROM HPartenaire P
          WHERE idHPartenaire = $idPart;";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }
     
     return $quest;
     
 } 
  
  public function getPartNameById($part)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT U.*, P.* FROM HUsers_BO U, HPartenaire P
          WHERE id_userbo=$part
          and U.idPartenaire = P.idHPartenaire;";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }
     
     return $quest;
     
 } 

 public function getSignByUserBo($idSign, $user)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT * FROM HSign_HPart WHERE idSignalement='$idSign' and idUserBO = $user;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest; 
    
} 


  public function getSignByPart($idSign, $part)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT * FROM HSign_HPart WHERE idSignalement='$idSign' and idUserBO 
          in (select id_userbo from HUsers_BO where idPartenaire = (select idPartenaire from HUsers_BO where id_Userbo=$part));";
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
          $sql = "SELECT *, date_format(dtCreaSignalement, '%d/%m/%Y') as theCreaDate FROM HSignalement_ WHERE idSignalement='$idSign';";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         error_log("ERREUR  - getSignById  !".$e->getMessage(). ' : '.$sql , 1, "alban.sestiaa@gmail.com");
         throw $e;
     }
     
     return $quest; 
     
 } 

 public function getSignBySituations($ville='%', $part='%', $etat='%', $search='%')
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
     $sql='';
    if($part!='%') {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and upper(A.ville) like upper('$ville')
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$part')
        and S.actif = 1
        and HS.etat like '$etat'
        and (upper(A.ville) like upper('$search') or upper(nomRue) like upper('%$search%') or upper(description) like upper('%$search%') )
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
    } elseif ($etat==1 || $etat==2 || $etat==0 ) {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A 
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and S.actif = 1
        and upper(A.ville) like upper('$ville')
        and HS.etat like '$etat'
        and (upper(A.ville) like upper('$search') or upper(nomRue) like upper('%$search%') or upper(description) like upper('%$search%') )
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";

    }
    
    if($sql=='')
    {

        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$part')
        and S.actif = 1
        and upper(A.ville) like upper('$ville%')
        and HS.etat like '$etat'
        and (upper(A.ville) like upper('$search') or upper(nomRue) like upper('%$search%') or upper(description) like upper('%$search%') )
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
    }   

    //$this->traceSql($sql,'getSignBySituations');

      try {
         
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         error_log("ERREUR  - getSignBySituations  !".$e->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
         throw $e;
     }
     
     return $quest;
     
 } 


 public function getSignPartBySituations($idSituation='%', $part='%', $etat='%')
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
     $sql='';
    if($part!='%') {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$part')
        and S.actif = 1
        and S.idSituation_pb like '$idSituation'
        and HS.etatPart like '$etat'
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
    } elseif ($etat==1 || $etat==2 || $etat==0 ) {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A 
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and S.actif = 1
        and S.idSituation_pb like '$idSituation'
        and HS.etatPart like '$etat'
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";

    }
    
    if($sql=='')
    {

        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$part')
        and S.actif = 1
        and S.idSituation_pb like '$idSituation'
        and HS.etatPart like '$etat'
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
    }   

    //$this->traceSql($sql,'getSignPartBySituations');

      try {
         
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         error_log("ERREUR  - getSignPartBySituations  !".$e->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
         throw $e;
     }
     
     return $quest;
     
 } 




 public function getSituationsBySign($idSign)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT distinct S.idSituation_pb, S.libMenu FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S
          WHERE 
          HS.idSignalement = SC.idSignalement and
          SC.idCritere = C.idcritere And
          C.idSituation_pb = S.idSituation_pb
          and HS.idSignalement = '$idSign'";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }
     
     return $quest;
     
 } 

 public function getStatsNbSignActif()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT count(idSignalement) as NB FROM HSignalement_";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

 public function getStatsNotation()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT Notation, count(`Notation`) as NB FROM `HSignalement_` group by `Notation`";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getStatsCriteres()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT libCritere, count(libcritere) as NB FROM HSignalement_HCritere SC, HCritere2 C
         WHERE SC.idCritere = C.idcritere
         group by libCritere
         order by count(libcritere) DESC";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getlistSituations()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT * FROM HSituation_pb2 S where actif=1 order by libMenu;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 


public function getStatsSituations()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT S.libMenu, count(S.libSituation) as NB FROM HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S
         WHERE SC.idCritere = C.idcritere And
         C.idSituation_pb = S.idSituation_pb
         and S.actif = 1
         group by libSituation
         order by count(libSituation) DESC";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getNewsUser($idUser)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "select showNews from HUsers_BO where id_userbo=$idUser;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getStatsVilles()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT upper(ville) as ville, count(upper(ville)) as NB FROM `HAdresse_` group by ville order by ville";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

 
public function getListPartenairePourRelance($etat, $query=1)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
    if($query!=1) {
        $sql = "select HSP.* from HSign_HPart HSP, HSignalement_ HS
        where HSP.idSignalement = HS.idSignalement
        and HS.etat not in (4, 8)
        and HSP.etat = $etat and  HSP.dtRelance < SUBDATE(now(),$query);";
    } else {
        $sql = "select HSP.* from HSign_HPart HSP, HSignalement_ HS
         where HSP.idSignalement = HS.idSignalement
         and HS.etat not in (4, 8)
        and HSP.etat = $etat and  HSP.dtRelance != '0000-00-00 00:00:00';";
    }

       try {
           
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }  
      
      return $quest;
      
  }   

public function getDestSignPart($idPartenaire)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT * from HUsers_BO where idPartenaire=$idPartenaire and destSign=1;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 



public function getListSuivisBySignPart($idSign)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "select  HSS.* from HSuivi HSS, HSignalement_ HS
         where HSS.idSignalement = HS.idSignalement
         and HSS.idSignalement = '$idSign'
         and HS.etat <> 8
         order by dtSuivi desc;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 


public function getSignalementPourRelanceManqueSuivi($idSign)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT HU.*, HSP.dtRelance, H.refSign FROM `HSign_HPart` HSP, HUsers_BO HU, HSignalement_ H 
         where HSP.idSignalement = '$idSign' 
         and HSP.etat=3  
         and HSP.idUserBO = HU.id_userbo 
         and HSP.idSignalement = H.idSignalement;";

        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 


public function getDroitsUser($idUser)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT HD.libDroit, HPD.accesDroit FROM `HUsers_BO` HBO, HPartenaire HP, HPart_HDroit HPD, HDroits_BO HD 
         where id_userbo=$idUser
         and HBO.idpartenaire = HP.idHPartenaire
         and HP.idHPartenaire = HPD.idPartenaire
         and HPD.idDroit = HD.idDroit;";

        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getConnectedUser()
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT U.nom_bo, U.prenom_bo, U.courriel, HT.* 
         FROM HTraceUser HT, HUsers_BO U
         where date_format(dtAction, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')
         and HT.user = concat(U.nom_bo, ' ', U.prenom_bo)
         order by HT.user, dtAction desc";

        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 

public function getUserBO($idUser='%')
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
        $sql = "SELECT * from HUsers_BO;";
         if($idUser!='%') $sql = "SELECT * from HUsers_BO where id_userbo=$idUser;";

        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 
 
public function getVisitBySign($idSign)
   /* tableau 
   * Créée le : 
   * Par : AST
   * Params : 
   * Modifs : 
   */
  {
       try {
           $sql = "SELECT * FROM `HRdvVisit` WHERE `IdSignalement` = '$idSign' order by creaVisit desc;";
          $select = $this->con->prepare($sql);
          
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);
              
      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }  
      
      return $quest;
      
  }  

  
  public function getListPartAffectSign($idSign, $affect)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT * FROM HSign_HPart WHERE `IdSignalement` = '$idSign' and affect=$affect";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }  
     
     return $quest;
     
 }  

 public function getListPartBySign($idSign)
  /* tableau 
  * Créée le : 
  * Par : AST
  * Params : 
  * Modifs : 
  */
 {
      try {
          $sql = "SELECT distinct HSP.*, HP.* FROM HSign_HPart HSP,  HUsers_BO HU, HPartenaire HP
          WHERE IdSignalement = '$idSign'
          and HSP.idUserBO = HU.id_userbo
          and HU.idPartenaire = HP.idHPartenaire";
         $select = $this->con->prepare($sql);
         
         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);
             
     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }  
     
     return $quest;
     
 }  

 
 public function getUserAffectBySign($idSign)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT HU.nom_bo, HU.prenom_bo, HP.libPartenaire, HP.idHPartenaire, HSP.*, date_format(HSP.dtAffect, '%d-%m-%Y') as dtAffectF
         FROM `HSign_HPart` HSP, HUsers_BO HU, HPartenaire HP
         where HSP.idSignalement = '$idSign'
         and HSP.idUserBO = HU.id_userbo
         and HU.idPartenaire = HP.idHPartenaire";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }  
    
    return $quest;
    
}  




public function getNewSignPart($idPart, $ville='%', $tri='0', $search='')
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    $orderBy='order by HS.dtCreaSignalement desc';
    if($tri == 'ville') $orderBy = 'order by A.ville, HS.dtCreaSignalement desc';
    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and SP.affect= 1
        and upper(A.ville) like upper('$ville')
        and (upper(A.ville) like upper('$search') or upper(nomRue) like upper('%$search%') or upper(description) like upper('%$search%') )
        and HS.logSoc in (".$_SESSION['logSociaux'].") ".$orderBy;
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}  

public function getSignPart($idPart, $ville='%', $tri='0', $search='', $etatPart='%')
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    $orderBy='order by HS.dtCreaSignalement desc';
    if($tri == 'ville') $orderBy = 'order by A.ville, HS.dtCreaSignalement desc';

    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.*, SP.etat as EP 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and SP.affect <> 1
        and SP.etat like '$etatPart'
        and upper(A.ville) like upper('$ville')
        and (upper(A.ville) like upper('$search') or upper(nomRue) like upper('%$search%') or upper(description) like upper('%$search%') )
        and HS.logSoc in (".$_SESSION['logSociaux'].") ".$orderBy;

        //$this->traceSql($sql, 'getSignPart');

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}  



public function getPartSignEtatBySign($idPart, $idSign )
/* tableau 
* Créée le : 
* Par : AST
* Params : Renvoi l'état du signalement lié au partenaire
* Modifs : 
*/
{
    try {
        $sql = "select * from HSign_HPart 
        where idSignalement='$idSign' 
        and idUserBO in (select id_userbo from HUsers_BO where idPartenaire=$idPart) ";

       // $this->traceSql($sql, 'getSignPart');

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getPartSignEtatBySign :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}  

public function getSignByEtatSignPart($idPart, $etatPart='%')
/* tableau 
* Créée le : 
* Par : AST
* Params : Renvoi uniquement les signalements cloturés du partenaire
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and SP.affect <> 1
        and SP.etat like '$etatPart'
        and HS.logSoc in (".$_SESSION['logSociaux'].");
        ";

       // $this->traceSql($sql, 'getSignPart');

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getSignByEtatSignPart :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}  



public function getSignPartByEtatPart_($idPart, $etatPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and SP.affect <> 1
        and HS.etatPart = $etatPart
        and HS.logSoc in (".$_SESSION['logSociaux'].");
        ";

       // $this->traceSql($sql, 'getSignPart');

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}  


public function getSignPartByAffect($idPart, $affect)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and SP.affect = $affect
        and HS.etatPart in (2,3)
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}

public function getSignPartByEtatPart($idPart, $etatPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.*, date_format(HS.dtCreaSignalement, '%d/%m/%Y') as dateFr, A.* 
        FROM HSignalement_ HS, HSignalement_HCritere SC, HCritere2 C, HSituation_pb2 S, HAdresse_ A, HSign_HPart SP, HPartenaire P  
        WHERE 
        HS.idSignalement = SC.idSignalement and
        SC.idCritere = C.idcritere And
        C.idSituation_pb = S.idSituation_pb
        and HS.idAdresse = A.idAdresse
        and HS.idSignalement = SP.idSignalement
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart')
        and S.actif = 1
        and HS.etatPart = $etatPart
        and HS.logSoc in (".$_SESSION['logSociaux'].")
        order by HS.dtCreaSignalement desc";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
}

public function getEtatAffectSignByPart($idSign, $idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {

        $sql = "SELECT SP.* FROM HSign_HPart SP, HUsers_BO U
        where SP.idSignalement='$idSign' 
        and SP.idUserBO = U.id_userbo
        and SP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire like '$idPart');";

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
} 


public function getEtatAffectSignAllPart($idSign)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {

        $sql = "SELECT SP.* FROM HSign_HPart SP, HUsers_BO U
        where SP.idSignalement='$idSign';";

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
} 

public function getlistVilles()
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct upper(A.ville) as ville FROM HAdresse_ A order by A.ville";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }  
   
   return $quest;
   
} 

public function checkMail4BO($mail)
 /* tableau 
 * Créée le : 
 * Par : AST
 * Params : 
 * Modifs : 
 */
{
     try {
         $sql = "SELECT * from HUsers_BO where courriel='$mail' and etatCompte=0;";
        $select = $this->con->prepare($sql);
        
        $select->execute();
        $quest = $select->fetchAll(PDO::FETCH_OBJ);
            
    } catch (Exception $e) {
        echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
        throw $e;
    }
    
    return $quest;
    
} 


public function updatePbSmiley() {
    /* A Supprimer
   * Créée le : 06/03/20
   * Par : AST
   * Params :
   */  
       
  
    try {
      
        $sql = "SELECT HSC.* FROM HSignalement_HCritere HSC,  HCritere2 HC, HSituation_pb2 HSP
        where HSC.idCriticite=0
        and HC.idCritere = HSC.idCritere
        and HC.idSituation_pb = HSP.idSituation_pb
        and HSP.actif = 1;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }

$x=0;
$res='';
foreach($quest as $key) {
    $sql = 'select HCT.* from HCriticite HCT, HCritere2 HC WHERE
    HCT.idCritere = HC.idCritere
    and HC.idCritere ='.$quest[$x]->idCritere.'
    and HCT.ordreCriticite = 1';

    $select = $this->con->prepare($sql);
       
    $select->execute();
    $tab = $select->fetchAll(PDO::FETCH_OBJ);

    $sql = 'update HSignalement_HCritere set idCriticite='.$tab[0]->idCriticite.' 
    where idSignalement = \''.$quest[$x]->idSignalement.'\' and idCritere='.$quest[$x]->idCritere.';';

    $select = $this->con->prepare($sql);
       
    $select->execute();
    $res=$res.$sql.'<br>';

    $x++;
}

   return $res;

    }

public function setPwsUserBO($mail, $pws) {
    /* tableau 
   * Créée le : 06/03/20
   * Par : AST
   * Params :mise à jour compte user BO : 0 en attente mdp, 1 : actif, 2 : suspendu
   */  
       
   try{
      
       $sql = "update HUsers_BO set pws_bo='".md5($pws)."', etatCompte=1 where courriel='$mail' and etatCompte=0;";
       $data_form = $this->con->prepare($sql);
       $data_form->execute();
      
       } catch (Exception $ex) {
               echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
               error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
               throw $ex;
                       
       }
    try {
      
        $sql = "SELECT * from HUsers_BO where courriel='$mail' and pws_bo='".md5($pws)."' and etatCompte=1;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }
   return $quest;

    }


    
public function checkSignClo($idSign)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
           $sql = "SELECT * from HSign_HPart where idSignalement='$idSign' and etat <> 4;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 
    
public function checkUserBO($mail, $pws)
    /* tableau 
    * Créée le : 
    * Par : AST
    * Params : 
    * Modifs : 
    */
   {
        try {
            $thePass=md5($pws);
            $sql = "SELECT * from HUsers_BO where courriel='$mail' and pws_bo='$thePass' and etatCompte=1;";
           $select = $this->con->prepare($sql);
           
           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);
               
       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }
       
       return $quest;
       
   } 

 

public function updateARSign($signId, $val) {

    try{
       
	    $sql = "update HSignalement_ set ar = $val where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}

public function traceSql($sqlSend, $func) {
        try{
            
            $sql = "insert into HTraceSql (sqlSend, fonction, dtCall) 
            values (:t_sql, :t_func, now())
            ";
            $data_form = $this->con->prepare($sql);
            $data_form->bindValue('t_sql', $sqlSend, PDO::PARAM_STR);
            $data_form->bindValue('t_func', $func, PDO::PARAM_STR);
           
        //  $data_form->beginTransaction();			
                $data_form->execute();
        // $data_form->commit();
            } catch (Exception $ex) {
                    echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                    error_log("ERREUR  -  traceSql !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                    throw $ex;
                            
            }
}

public function traceUser($user, $action) {
    try{
        
        $sql = "insert into HTraceUser (user, actionUser) 
        values (:t_user, :t_action)";
        $data_form = $this->con->prepare($sql);
        $data_form->bindValue('t_user', $user, PDO::PARAM_STR);
        $data_form->bindValue('t_action', $action, PDO::PARAM_STR);
       
    //  $data_form->beginTransaction();			
            $data_form->execute();
    // $data_form->commit();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
}

public function updategeolocSign($val, $signId) {

    try{
       
	    $sql = "update HSignalement_ set geolocalisation = '$val' where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}


public function updateChargeSign($val, $signId) {

    try{
       
	    $sql = "update HSignalement_ set dtPriseEnCharge = now(), suiviPar='$val', etat=2 where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

        return date('d-m-Y h:i:s').' par '.$val;

}

public function updateNoteSign($val, $signId) {

    try{
       
	    $sql = "update HSignalement_ set notation = '$val' where idSignalement = '$signId';  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}




public function updateNewsUser($userId) {

    try{
       
	    $sql = "update HUsers_BO set showNews=1 where id_userbo = $userId;  ";
        $data_form3 = $this->con->prepare($sql);
       
        $data_form3->execute();
        
       
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

public function addSuivi($idSign,$com,$user,$ipSce, $visi, $idPart, $init=3) {

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
                error_log("ERREUR  - addSuivi  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
      
        //si suivi d'affectation de part ($init=1) alors
            // si existe déjà suivi : etat pour ce user =3
            // si pas de suivi de signalement : etat pour tous users du partenaire = 1

        try{
       
            $sql = "update HSign_HPart set etat=$init where idSignalement='$idSign' 
            and idUserBO in (select id_userbo from HUsers_BO where idPartenaire=$idPart)";
            $data_form2 = $this->con->prepare($sql);
            
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

   public function addAffectSignPart($idSign, $affect, $idUser) {

    try{
       
        $sql = "insert into HSign_HPart (idSignalement, idUserBO, dtAlert, etat, dtRelance, affect, dtAffect) 
	    values (:t_idSign, :t_idUser, now(), 3, now(), :t_affect, now()) ";
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_idSign', $idSign, PDO::PARAM_STR);
        $data_form2->bindValue('t_idUser', $idUser, PDO::PARAM_STR);
        $data_form2->bindValue('t_affect', $affect, PDO::PARAM_STR);
        
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - addAffectSignPart !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   } 


public function updatePartenaire($idSign, $partUserBO, $etat) {

    try{
       
	    $sql = "insert into HSign_HPart (idSignalement, idUserBO, dtAlert, etat, dtRelance) 
	    values (:t_idSign, :t_part, now(), :t_etat, now()) ";
        $data_form2 = $this->con->prepare($sql);
    	
        $data_form2->bindValue('t_idSign', $idSign, PDO::PARAM_STR);
        $data_form2->bindValue('t_part', $partUserBO, PDO::PARAM_STR);
        $data_form2->bindValue('t_etat', $etat, PDO::PARAM_STR);
        $data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
   }

   
   
public function updateEtatSignalement($idSign, $etat) {

    try{
       
	    $sql = "update HSignalement_ set etat=$etat where idSignalement='$idSign';";
        $data_form2 = $this->con->prepare($sql);
    	$data_form2->execute();
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  -  updateEtatSignalement  !".$ex->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }
//si etat envoyé =3 alors etat partenaire doit passer à 1 (sauf si déjà affecté...)
  $sign = $this->getSignById($idSign);
  if($etat==3 && $sign[0]->etatPart <= 1 ) $this->updateEtatPartSignalement($idSign, 1);

   }

public function updateEtatPartSignalement($idSign, $etat) {

   
    try{
       
    $sql = "update HSignalement_ set etatPart=$etat where idSignalement='$idSign';";
    $data_form2 = $this->con->prepare($sql);
    $data_form2->execute();
    } catch (Exception $ex) {
            echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
            error_log("ERREUR  -  updateEtatSignalement  !".$ex->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
            throw $ex;
                    
    } 

   }

   
public function updateEtatAllPartSignalement($idSign, $idUser, $etat) {

   
    try{
       
    $sql = "update HSign_HPart set etat=$etat, affectBy=$idUser where idSignalement='$idSign';";
    $data_form2 = $this->con->prepare($sql);
    $data_form2->execute();
    } catch (Exception $ex) {
            echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
            error_log("ERREUR  -  updateEtatSignalement  !".$ex->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
            throw $ex;
                    
    } 

   }

public function updateEtatSignPartBySignalement($idSign, $idPart, $etat) {
    //Mise à jour de tous les users d'un partenaire affectés à un signalement
    try{
       
    $sql = "update HSign_HPart set etat=$etat 
    where idSignalement='$idSign' 
    and idUserBO in (select id_userbo from HUsers_BO where idPartenaire = $idPart);";
    $data_form2 = $this->con->prepare($sql);
    $data_form2->execute();
    } catch (Exception $ex) {
            echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
            error_log("ERREUR  -  updateEtatSignPartBySignalement  !".$ex->getMessage()." : ".$sql , 1, "alban.sestiaa@gmail.com");
            throw $ex;
                    
    } 

   }

   
public function updateRelance($signId, $userbo) {
           
    try{ 
        $sql = "update HSign_HPart set dtRelance=now()
        where idSignalement = '$signId'
        and idUserBO = $userbo;  ";    
        
        $data_form3 = $this->con->prepare($sql);
        $data_form3->execute();
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}


public function updateSignPart($idSign, $part, $etat) {
           
    try{ 
        $sql = "update HSign_HPart set dtRelance=now(), etat = $etat
        where idSignalement = '$signId'
        and idUserBO = $part;  ";    
        
        $data_form3 = $this->con->prepare($sql);
        $data_form3->execute();
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - updateSignPart !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}

public function updateAffectPart($idSign, $affect, $user, $etat) {
           
    try{ 
        $sql = "update HSign_HPart set dtAffect=now(), affect = $affect, etat = $etat, affectBy = $user
        where idSignalement = '$idSign'
        and idUserBO in (select id_userbo from HUsers_BO where idPartenaire = (select idPartenaire from HUsers_BO where id_userbo=$user));  ";    
       // $this->traceSql($sql, 'updateAffectPart');
        $data_form3 = $this->con->prepare($sql);
        $data_form3->execute();
       
        } catch (Exception $ex) {
                echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                error_log("ERREUR  - updateAffectPart !".$ex->getMessage().' : '.$sql , 1, "alban.sestiaa@gmail.com");
                throw $ex;
                        
        }

}

public function  setCritereSignalement($idCrit, $idSign)   {
        /* tableau 
       * Créée le : 06/03/20
       * Par : AST
       * Params : id d'un critere lié à un signalement
       * 
       * Modifs : 
       */  
           
       try{
          
           $sql = "insert into HSignalement_HCritere (idSignalement, idCritere, dtCrea) 
           values (:t_sign, :t_crit, now()) ";
           $data_form = $this->con->prepare($sql);
           $data_form->bindValue('t_crit', $idCrit, PDO::PARAM_STR);
           $data_form->bindValue('t_sign', $idSign, PDO::PARAM_STR);
           $data_form->execute();
          
           } catch (Exception $ex) {
                   echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
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

        

public function deleteSign($signId) {

            try{
                $sql = "SELECT * FROM HSignalement_ where idSignalement='".$signId."';";
                $select = $this->con->prepare($sql);
                $select->execute();
                $quest = $select->fetchAll(PDO::FETCH_OBJ);

                

                $sql = "delete from HSignalement_ where idSignalement = '$signId';  ";
                $data_form3 = $this->con->prepare($sql);
                $data_form3->execute();
                
                $sql = "delete from HAdresse_ where idAdresse = '".$quest[0]->idAdresse."';  ";
                $data_form3 = $this->con->prepare($sql);
                $data_form3->execute();
                   
                $sql = "delete from HSignalement_HCritere where idSignalement = '$signId';  ";
                $data_form3 = $this->con->prepare($sql);
                $data_form3->execute();

               
                } catch (Exception $ex) {
                        echo  " <br><b>Une erreur est survenue lors de l'enregistrement. Merci de réessayer ultérieurement : </b>".$sql."\n";
                        error_log("ERREUR  - insertKEY stats  !".$ex->getMessage() , 1, "alban.sestiaa@gmail.com");
                        throw $ex;
                                
                }
        
        }

}