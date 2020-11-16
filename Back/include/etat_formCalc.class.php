<?php

class etat_formCalc {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }

    public function getScoreMaxBySituation()
    /* tableau
    * Créée le :
    * Par : AST
    * Params :
    * Modifs :
    */
   {
        try {
            $sql = "select HS.idSituation_pb, HS.libSituation, sum(poidsCritere*3) as scoreMaxSit from HSituation_pb2 HS, HCritere2 HC
            where HS.actif=1
            and HS.idSituation_pb = HC.idSituation_pb
            group by HS.libSituation, HS.idSituation_pb;";
           $select = $this->con->prepare($sql);

           $select->execute();
           $quest = $select->fetchAll(PDO::FETCH_OBJ);

       } catch (Exception $e) {
           echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
           throw $e;
       }

       return $quest;

   }

   public function getNbreMaxCritBySituation()
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
           $sql = "  select HS.idSituation_pb, HS.libSituation, count(poidsCritere) as nbreMaxCritBySit from HSituation_pb2 HS, HCritere2 HC
           where HS.actif=1
           and HS.idSituation_pb = HC.idSituation_pb
           group by HS.libSituation, HS.idSituation_pb;";
          $select = $this->con->prepare($sql);

          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);

      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }

      return $quest;

  }

  public function getSignBySituations($idSituation='%')
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
           $sql = "select * from HSignalement_";
          $select = $this->con->prepare($sql);

          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);

      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }

      return $quest;

  }

public function getScoreBySituationPourSign($idSign)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
           $sql = "select sum(HC.poidsCritere*HC2.ordreCriticite) as ScoreSitSign, idSituation_pb from HSignalement_HCritere HSC, HCritere2 HC, HCriticite HC2
           where HSC.idSignalement = '$idSign'
           and HSC.idCritere = HC.idCritere
           and HSC.idCriticite = HC2.idCriticite
           group by idSituation_pb;";
          $select = $this->con->prepare($sql);

          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);

      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }

      return $quest;

  }

  public function getNombreEnfant($idSignalement)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
           $sql = "SELECT OccupantsEnfants FROM HSignalement_
           WHERE idSignalement='$idSignalement'";
          $select = $this->con->prepare($sql);
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);


      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }

      return $quest;

  }

  public function getDangerMax($idSign)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
           $sql = "SELECT danger FROM HSignalement_
           WHERE idSignalement='$idSign'";
          $select = $this->con->prepare($sql);
          $select->execute();
          $quest = $select->fetchAll(PDO::FETCH_OBJ);


      } catch (Exception $e) {
          echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
          throw $e;
      }

      return $quest;

  }

  public function getDanger($idSign)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
      $sql = "select danger from HSignalement_HCritere HSC, HCritere2 HC, HCriticite HC2
      where HSC.idSignalement = '$idSign'
      and HSC.idCritere = HC.idCritere
      and HSC.idCriticite = HC2.idCriticite";
     $select = $this->con->prepare($sql);

     $select->execute();
     $quest = $select->fetchAll(PDO::FETCH_OBJ);

 } catch (Exception $e) {
     echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
     throw $e;
 }

 return $quest;

  }

  public function updateDanger($idSign,$scoreTotal,$scoreSelec,$scoreEnfant)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
      $sql = "update HSignalement_ set cotationAuto = $scoreTotal, cotationSituations = $scoreSelec, cotationCorrigee = $scoreEnfant where idSignalement = '$idSign'";
     $select = $this->con->prepare($sql);
     $select->execute();

 } catch (Exception $e) {
     echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
     throw $e;
 }

  }

  public function updateDangerSignalement($idSign)
   /* tableau
   * Créée le :
   * Par : AST
   * Params :
   * Modifs :
   */
  {
       try {
      $sql = "update HSignalement_ set danger=1 where idSignalement = '$idSign'";
     $select = $this->con->prepare($sql);
     $select->execute();

 } catch (Exception $e) {
     echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
     throw $e;
 }

  }




  public function getNbreCritBySituationPourSign($idSign)
  /* tableau
  * Créée le :
  * Par : AST
  * Params :
  * Modifs :
  */
 {
      try {
          $sql = "select count(HC.poidsCritere) as nbreCritSign, idSituation_pb from HSignalement_HCritere HSC, HCritere2 HC
          where HSC.idSignalement = '$idSign'
          and HSC.idCritere = HC.idCritere
          group by idSituation_pb;";
         $select = $this->con->prepare($sql);

         $select->execute();
         $quest = $select->fetchAll(PDO::FETCH_OBJ);

     } catch (Exception $e) {
         echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
         throw $e;
     }

     return $quest;

 }

public function getRelancesSurAffectation()
 /* tableau
 * Créée le :
 * Par : AST
 * Params :
 * Modifs :
 */
{
       
     try {
         $sql = "SELECT U.courriel, date_format(dateEnvoi, '%d-%m-%Y') as dateEnvoiF, HT.* FROM `HTraceMail` HT, HUsers_BO U 
         where date_format(HT.dateEnvoi, '%d-%m-%Y') = (select date_format(max(dateEnvoi), '%d-%m-%Y') from HTraceMail)
         and HT.destinataire = U.id_userbo
         ORDER BY courriel, HT.`dateEnvoi` DESC;";
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


public function getNbreSignByMonths()
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT date_format(dtCreaSignalement, '%Y-%m') as moisCrea , count(idSignalement) as nb
        FROM `HSignalement_`
        group by date_format(dtCreaSignalement, '%m-%Y')
        order by date_format(dtCreaSignalement, '%m-%Y');
        ";

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getNbreSignClotureForMonth($dt)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT count(*) as nbC from HSignalement_ 
        where etat=8 and date_format(dtCreaSignalement, '%Y-%m') = '$dt'
        ";

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getListSignByPartAndEtatpart($idPart, $etat='%')
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT count(*) as NB, HP.libPartenaire FROM `HSign_HPart` HSP, HUsers_BO HU, HPartenaire HP
        where HSP.idUserBO = HU.id_userbo
        and HU.idPartenaire = HP.idHPartenaire
        and HP.idHPartenaire = $idPart
        and HSP.etat like '$etat';
        ";

       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getListSignByEtatForPart($idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT count(*) as NB, HP.libPartenaire, HSP.etat FROM `HSign_HPart` HSP, HUsers_BO HU, HPartenaire HP
        where HSP.idUserBO = HU.id_userbo
        and HU.idPartenaire = HP.idHPartenaire
        and HP.idHPartenaire = $idPart
        group by HSP.etat
        order by etat;
        ";

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
 
public function getListSignSuiviXJoursByPart($delais, $idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : Suivi qui ne concerne pas la cloture du signalement
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.idSignalement FROM HSuivi HS, HSign_HPart HSP
        where 
        HS.idSignalement = HSP.idSignalement
        and HS.dtSuivi > DATE_SUB(CURRENT_DATE, INTERVAL $delais day)
        and HSP.etat not in (4, 8, 5)    
        and HS.idSignalement in (select idSignalement from HSign_HPart where idUserBO in (select id_userbo from HUsers_BO where idPartenaire = $idPart) )    
        order by HS.dtSuivi DESC;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getListSignSuiviXJoursByPart:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 


 
public function getListSignCloturesXJoursForPart($delais, $idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT distinct HS.idSignalement FROM HSuivi HS, HSign_HPart HSP
        where 
        HS.idSignalement = HSP.idSignalement
        and HS.dtSuivi > DATE_SUB(CURRENT_DATE, INTERVAL $delais day)
        and HSP.etat in (4, 8)    
        and HS.idSignalement in (select idSignalement from HSign_HPart where idUserBO in (select id_userbo from HUsers_BO where idPartenaire = $idPart) )    
        order by HS.dtSuivi DESC;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection :</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 



public function getListSuiviBySignXJours($delais=7, $idSign)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT HS.*, date_format(dtSuivi, '%d-%m-%Y') as dtSuiviF, HP.libPartenaire FROM HSuivi HS, HPartenaire HP
        where dtSuivi > DATE_SUB(CURRENT_DATE, INTERVAL $delais DAY)
        and idSignalement = '$idSign'
        and HS.idPartenaire = HP.idHPartenaire
        order by dtSuivi DESC;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getListSuiviBySignXJours:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getListSignNcByPart($idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : renvoi la liste des signalements d'un part NON CLOTURES
* Modifs : 
*/
{
    try {
        $sql = "select distinct idSignalement from HSign_HPart HSP
        where HSP.idUserBO in (select id_userbo from HUsers_BO where idPartenaire = $idPart)
            and HSP.etat not in (4, 8, 5)
            order by dtAffect;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getListSignNcByPart:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getListDerniersSuivisBySign($idSign)
/* tableau 
* Créée le : 
* Par : AST
* Params : renvoi la liste des suivis d'un signalement par date suivi desc
* Modifs : 
*/
{
    try {
        $sql = "SELECT idPartenaire, dtSuivi FROM `HSuivi` where idSignalement = '$idSign'
        order by dtSuivi desc;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getListSuiviBySignXJours:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 


public function getUsersForRapport($idPart)
/* tableau 
* Créée le : 
* Par : AST
* Params : renvoi la liste des suivis d'un signalement par date suivi desc
* Modifs : 
*/
{
    try {
        $sql = "SELECT * FROM HUsers_BO
        where envoiRapport = 1
        and idPartenaire = $idPart";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getUsersForRapport:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
} 

public function getInfosSign($idSign)
/* tableau 
* Créée le : 
* Par : AST
* Params : 
* Modifs : 
*/
{
    try {
        $sql = "SELECT H.*, HA.*, date_format(dtCreaSignalement, '%d-%m-%Y') as dtCreaSignalementF FROM HSignalement_ H, HAdresse_ HA
        where idSignalement = '$idSign'
        and H.idAdresse = HA.idAdresse;";
       $select = $this->con->prepare($sql);
       
       $select->execute();
       $quest = $select->fetchAll(PDO::FETCH_OBJ);
           
   } catch (Exception $e) {
       echo $e->getMessage() . " <br><b>Erreur lors de la selection getInfosSign:</b>\n".$sql;
       throw $e;
   }
   
   return $quest;
   
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

} //fin class
