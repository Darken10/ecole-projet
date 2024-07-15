<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Helpers\Payment as HelpersPayment;

class PaymentController extends Controller
{
    function return_function(Request $request)
    {
        $payment = auth()->user()->payment;
        if($payment==null){
            $token = $payment->token;
            $payin_statut = HelpersPayment::StatusPayin($token);
            if(isset($payin_statut)) {
                $payment->statut = $payin_statut->status;
                $payment->save();
            }
        }
    }

    function callback_function(Request $request)
    {
        $payment = auth()->user()->payment;
        if($payment==null){
            $token = $payment->token;
            $payin_statut = HelpersPayment::StatusPayin($token);
            if(isset($payin_statut)) {
                $payment->statut = $payin_statut->status;
                $payment->save();
                dump("payment ok",$payin_statut,$payment);
            }else{
                dump("error",$payin_statut);
            }
        }
    }

    function cancel_function()
    {
    }

    function lancer_payment(Request $request)
    {
        $transaction_id = $this->create_trans_id();
        $montant = 100;
        $payment = $this->create_payment_item($transaction_id, $montant);
        $redirectPayin = HelpersPayment::Payin_with_redirection($transaction_id, $montant);
        $payment->token = $redirectPayin->token;
        $payment->save();

        if (isset($redirectPayin->response_code) and $redirectPayin->response_code == "00") {
            header('Location: ' . $redirectPayin->response_text);
        } else {
            dd($redirectPayin);
        }
    }

    private function create_payment_item(string $transaction_id, int $montant): Payment
    {
        $payment = auth()->user()->payment;
        if ($payment==null) {
            $payment = Payment::create([
                'transaction_id' => $transaction_id,
                'montant' => $montant,
                'user_id' => auth()->user()->id,
            ]);
        }

        return $payment;
    }

    private function create_trans_id(): string
    {
        $trans_id = 'LGD' . date('Y') . date('m') . date('d') . '.' . date('h') . date('m') . '.C' . rand(5, 99999999) . '.' . uniqid();

        return $trans_id;
    }


}
