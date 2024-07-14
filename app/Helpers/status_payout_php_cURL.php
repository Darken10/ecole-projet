<?php
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

function StatusPayout($withdrawalToken){
	
$curl = curl_init();

curl_setopt_array($curl, array(
  //CURLOPT_URL => "https://app.ligdicash.com/pay/v01/straight/payout/confirm/?payoutToken=".$withdrawalToken,
  CURLOPT_URL => "https://app.ligdicash.com/pay/v01/withdrawal/confirm/?withdrawalToken=".$withdrawalToken,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Apikey: YNYZ3BXIFWRBBPFQ2",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiI3NzQiLCJpZF9hYm9ubmUiOiI4OTk0MiIsImRhdGVjcmVhdGlvbl9hcHAiOiIyMDIxLTA4LTE4IDE4OjIwOjQyIn0.8rMinJMEDZeeoGNqcKxwD2VjXPC5t1__ilTJIOwFtQ4"
  ),
));
$response = json_decode(curl_exec($curl));
curl_close($curl);
return $response;
}


//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX

/*
 En cas de reclamation ou de besoin de correction ou verrification d'une transaction payout,
 vous pouvez rappeler la transaction en recuperant le token par session ou depuis votre DB
 Raison pour laquel vous devez stocker le 'payoutToken=' de votre transaction client dans votre base de données historique transaction ou en variable SESSION
 On suppose que le 'payoutToken=' est recuperé par exemple
*/
//echo $_GET['token'];
//$payoutToken=$_GET['token'];

//session_start();
$payoutToken=$_SESSION['payoutToken'];


$Payout = StatusPayout($payoutToken);

    if(isset($Payout->status)) {
		if(trim($Payout->status)=="completed") {
			  echo "Le système Ligdicash a validé le PAYOUT en attent vous devez executé vos traitements apres paiement valide<br><br>";
			  //print_r($Payout);
			  echo 'status='.$Payout->status;
			  echo '<br><br>';
			  echo 'response_text='.$Payout->response_text;
		  }
		 elseif(trim($Payout->status)=="nocompleted") {
			  echo "Le système Ligdicash a annulé le paiement donc vous devez executer vos traitements correspondant<br><br>";
			  //print_r($Payout);
			  echo 'status='.$Payout->status;
			  echo '<br><br>';
			  echo 'response_text='.$Payout->response_text;
			  
		 }
		elseif(trim($Payout->status)=="pending") {
          echo "Le PAYOUT s'est bien passé et est en attente de validation par le systeme Ligdicash donc vous devez executer vos traitements correspondant<br><br>";
          //print_r($Payout);
		  echo 'status='.$Payout->status;
		  echo '<br><br>';
		  echo 'response_text='.$Payout->response_text;

        }
		else{
		 echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]<br>';
         echo 'response_text='.$Payout->response_text;
        }
    }else{
		print_r($Payout);
    }

?>

 
