<?php

function Payout_to_wallet($transaction_id,$receiver,$amount){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://app.ligdicash.com/pay/v01/withdrawal/create",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>'{
						  "commande": {
							  "amount": "'.$amount.'",
							  "description": "Description of the content of the WITHDRAWAL",
							  "customer": "'.$receiver.'",
							  "custom_data": {
								  "transaction_id": "'.$transaction_id.'"
							  },
							  "callback_url": "can contain your successful withdrawal URL, if processed at your level, this is optional",
							  "top_up_wallet":1
						  }
						}',
  CURLOPT_HTTPHEADER => array(
    "Apikey: YNYZ3BXIFWRBBPFQ2",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiI3NzQiLCJpZF9hYm9ubmUiOiI4OTk0MiIsImRhdGVjcmVhdGlvbl9hcHAiOiIyMDIxLTA4LTE4IDE4OjIwOjQyIn0.8rMinJMEDZeeoGNqcKxwD2VjXPC5t1__ilTJIOwFtQ4",
    "Accept: application/json",
    "Content-Type: application/json"
  ),
));

$response = json_decode(curl_exec($curl));

curl_close($curl);
return $response;
}


session_start();
//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX
$transaction_id='LGD'.date('Y').date('m').date('d').'.'.date('h').date('m').'.C'.rand(5,100000);
$amount=100;
//$customer='22676164342';
//$customer='22997761182';
$customer='22607070708';


$PayoutClient =Payout_to_wallet($transaction_id,$customer,$amount);
//vous pouvez decommenter print_r($PayoutClient) pour voir les resultats vour la documentationV1.2
//print_r($PayoutClient);exit;

if(isset($PayoutClient->response_code) and $PayoutClient->response_code=="00") {
   echo "<br><br>Le PAYOUT(Retrait) s'est bien passé et le portefeuille client Ligdicash est bien crédité,donc vous devez executer des traitement correspondant<br><br>";
	$_SESSION['payoutToken']=$PayoutClient->token;
	echo 'payoutToken='.$PayoutClient->token;
}
else{
	echo 'response_code='.$PayoutClient->response_code;
	echo '<br><br>';
	echo 'response_text='.$PayoutClient->response_text;
	echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]<br>';
	exit;
}

//Vous pouvez mettre cette partie en commentaire pour voir les status apres payout
//Ce fonction est un exemple de verrification de status que vous povez reinmplementer
include('status_payout_php_cURL.php');

?>

 
