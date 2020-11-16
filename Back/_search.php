<?php
//'mainPart.php?p=o&s=%&search='+searchT
//ini_set('display_errors',1);

if(isset($_POST['searchTerms'])) {
    $searchT = $_POST['searchTerms'];
    header("Location:mainPart.php?p=o&s=%&search=".$searchT);
}

if(isset($_POST['searchTermsMain'])) {
    $searchT = $_POST['searchTermsMain'];
    header("Location:main.php?p=n&s=%&search=".$searchT);
}


//echo $searchT;



?>