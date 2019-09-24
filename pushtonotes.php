<?php
// https://theapiguys.com/20140107-8020-php-course-archive/

require_once("isdk.php");
$app = new iSDK;
//Test Connection
if( $app->cfgCon("gr478"))
{ //echo "You are connected"; 

  $contactId = $_REQUEST['contactId'];

  $returnFields = array('_ROMMEngagementDay', '_ExpectedWeddingDate', '_PhotographyServices', '_AnythingElseYouWouldLikeToKnow');
  $conDat = $app->loadCon($contactId, $returnFields);

    $de = date_create($conDat['_ROMMEngagementDay']);
    $date_engage = date_format($de, 'F n, Y');
    $ed = date_create($conDat['_ExpectedWeddingDate']);
    $expect_date = date_format($ed, 'F n, Y');

    $notes = 'When is your ROMM/Engagement day? '.$date_engage.'  
    When is your wedding day? '.$expect_date.'
    Do you need photography services? '.$conDat['_PhotographyServices'].'
    Is there anything else you would like to know? '.$conDat['_AnythingElseYouWouldLikeToKnow'];

  $conDat = array('ContactNotes' => $notes);
  $conID = $app->updateCon($contactId, $conDat);
  

}
else{
echo "Not Connected";
}

?>