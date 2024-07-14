<?php 

namespace App\Helpers;

class Payment{

    public static function Payin_with_redirection($transaction_id,$amount){

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
                                  "website_url": "'.env('LDG_MY_WEBSITE').'"
                                },
                                "actions": {
                                  "cancel_url": "'.env('LDG_CANCEL_URL').'",
                                  "return_url": "'.env('LDG_RETURN_URL').'",
                                  "callback_url": "'.env('LDG_CALLBACK_URL').'"
                                },
                                "custom_data": {
                                  "transaction_id": "'.$transaction_id.'" 
                                }
                              }
                            }',
          CURLOPT_HTTPHEADER => array(
            "Apikey: ".env('LDG_API_KEY '),
            "Authorization: Bearer ".env('LDG_API_SECRET'),
            "Accept: application/json",
            "Content-Type: application/json"
          ),
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);
        return $response;
    }

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
                                  "website_url": "'.env('LDG_MY_WEBSITE').'"
                                },
                                "actions": {
                                  "cancel_url": "'.env('LDG_CANCEL_URL').'",
                                  "return_url": "'.env('LDG_RETURN_URL').'",
                                  "callback_url": "'.env('LDG_CALLBACK_URL ').'"
                                },
                                "custom_data": {
                                  "transaction_id": "'.$transaction_id.'" 
                                }
                              }
                            }',
          CURLOPT_HTTPHEADER => array(
            "Apikey: ".env('LDG_API_KEY '),
            "Authorization: Bearer ".env('LDG_API_SECRET'),
            "Accept: application/json",
            "Content-Type: application/json"
          ),
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);
        return $response;
        }


    public static function StatusPayin($invoiceToken){

        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/confirm/?invoiceToken=".$invoiceToken,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Apikey: YNYZ3BXIFWRBBPF",
                "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhciOiJIUzI1NiJ9.eyJpZF9hcHAiOiI3NzQiLCJpZF9hYm9ubmUiOiI4OTk0MiIsImRhdGVjcmVhdGlvbl9hcHAiOiIyMDIxLTA4LTE4IDE4OjIwOjQyIn0.8rMinJMEDZeeoGNqcKxwD2VjXPC5t1__ilTJIOwFtQ4"
            ),
        ));
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
    
        return $response;
    }
}
