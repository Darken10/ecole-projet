<?php
//lES PAIEMENT SANS REDIRCTION CONCERNE UNIQUE LES MOBILE MONEY
// ET SEUL LES PAYINs AVEC REDIRECTION TIENS COMPTE DE TOUTES LES METHODES
function Payin_without_redirection($transaction_id,$customer,$amount,$otp=''){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://app.ligdicash.com/pay/v01/straight/checkout-invoice/create",
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
						  "customer": "'.$customer.'",
						  "customer_firstname":"Prenom du client",
						  "customer_lastname":"Nom du client",
						  "customer_email":"tester@ligdicash.com",
						  "external_id":"",
						  "otp": "'.$otp.'"
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

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

session_start();
//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX
$transaction_id='LGD'.date('Y').date('m').date('d').'.'.date('h').date('m').'.C'.rand(5,100000);
$amount=100;
//$customer='22670087487';
//$customer='22997761182';
//$customer='22676164345';
$customer='22676275726';
$opt="692242";//Uniquement pour orangeMoney sinon laisser vide

$directPayin =Payin_without_redirection($transaction_id,$customer,$amount,$opt);

//vous pouvez decommenter print_r($response) pour voir les resultats vour la documentationV1.2
//print_r($directPayin);exit;
//echo $directPayin->response_text;exit;
//echo $directPayin->token;exit;//Ce token doit etre enregistrer dans votre base de donne trasction client pour vos verrification de status apres paiement
$_SESSION['invoiceToken']=$directPayin->token;//Vous devez stoker ce TOKEN pour de verrification de status ulterieur

if(isset($directPayin->response_code) and $directPayin->response_code=="00") {
	echo 'response_code='.$directPayin->response_code;
	echo '<br><br>';
	echo 'response_text='.$directPayin->response_text;
	echo '<br><br>';
	echo 'invoiceToken='.$directPayin->token;
	echo '<br><br>';
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


//Ce fonction est un exemple de verrification de status que vous povez reinmplementer
sleep(5);//C'est le temps pour obtenir un reponse de l'API partenaire de ligdicash et l'autorisation du clients
include('status_payin_php_cURL.php');

?>

