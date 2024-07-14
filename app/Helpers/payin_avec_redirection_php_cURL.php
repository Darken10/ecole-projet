<?php

function Payin_with_redirection($transaction_id,$amount){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/create",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>'
					  {
					  "commande": {
						"invoice": {
						  "items": [
							{
							  "name": "Nom de article ou service ou produits",
							  "description": "Description du service ou produits",
							  "quantity": 1,
							  "unit_price": "'.$amount.'",
							  "total_price": "'.$amount.'"
							}
						  ],
						  "total_amount": "'.$amount.'",
						  "devise": "XOF",
						  "description": "Descrion de la commande des produits ou services",
						  "customer": "",
						  "customer_firstname":"Prenom du client",
						  "customer_lastname":"Nom du client",
						  "customer_email":"tester@ligdicash.com"
						},
						"store": {
						  "name": "NomDeMonprojet",
						  "website_url": "https://monsite.com"
						},
						"actions": {
						  "cancel_url": "https://monsite.com",
						  "return_url": "http://localhost/api/api_public_ligdicash/status_payin_php_cURL.php",
						  "callback_url": "http://localhost/api/api_public_ligdicash/status_payin_php_cURL.php"
						},
						"custom_data": {
						  "transaction_id": "'.$transaction_id.'" 
						}
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


//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX

/*
 En cas de reclamation ou de besoin de correction ou verrification d'une transaction,
 vous pouvez rappeler la transaction en recuperant le token par session ou depuis votre DB ou par variable $_GET['token']
 Raison pour laquel vous devez stocker le 'invoiceToken=' de votre transaction client dans votre base de données historique transaction ou en variable SESSION
 On suppose que le 'invoiceToken=' est recuperé par exemple
*/
//echo $_GET['token'];
//$invoiceToken=$_GET['token'];

session_start();
//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX
$transaction_id='LGD'.date('Y').date('m').date('d').'.'.date('h').date('m').'.C'.rand(5,100000);
$amount=100;

$redirectPayin =Payin_with_redirection($transaction_id,$amount);

//vous pouvez decommenter print_r($response) pour voir les resultats vour la documentationV1.2
//print_r($redirectPayin);exit;
//echo $redirectPayin->response_text;exit;
//echo $redirectPayin->token;exit;//Ce token doit etre enregistrer dans votre base de donne trasction client pour vos verrification de status apres paiement 
$_SESSION['invoiceToken']=$redirectPayin->token;//Vous devez stoker ce TOKEN pour de verrification de status ulterieur

if(isset($redirectPayin->response_code) and $redirectPayin->response_code=="00") {
	//$redirectPayin->response_text contient l'url de redirection
	header('Location: '.$redirectPayin->response_text);
}
else{
	echo 'response_code='.$directPayin->response_code;
	echo '<br><br>';
	echo 'response_text='.$directPayin->response_text;
	echo '<br><br>';
	echo 'description='.$directPayin->description;
	echo '<br><br>';
	echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]';
	exit;
}

?>

 
