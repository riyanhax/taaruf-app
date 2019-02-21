<?php
namespace app;

class Clickatell {

    public function sendSMS($pMobileNumber, $code){

        /*    $user = 'seefnsrl_api';
        $pass = 'rb28Nmi';
        //$api_id = urlencode('DnTd2pfESgaPZzxkq2lQhg==');
        $to = $pMobileNumber;
        $message = "kode Verifikasi Taa'ruf Syar'i : ".$code;
        /*$response = file_get_contents("https://api.clickatell.com/http/send"."?user=$username&password=$password&api_id=$api_id&to=$to&text=$message"); */
         //$response  = file_get_contents("https://platform.clickatell.com/messages/http/send?apiKey=$api_id&to=$to&content=$message");
        //echo $response;

    /*    $response =file_get_contents('http://api.nusasms.com/api/v3/sendsms/plain?user='.$user.'&password='.$pass.'&SMSText='.$message.'&GSM='.$to.'&output=json');  */

       /* $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'user' => 'seefnsrl_api',
                'password' => 'rb28Nmi',
                'SMSText' => "kode Verifikasi Taa'ruf Syar'i : ".$code,
                'GSM' => $pMobileNumber
            )
        ));
            $resp = curl_exec($curl);
            if (!$resp) {
                return $resp;
            } else {
                header('Content-type: text/xml'); 
                return $resp;
            }
            curl_close($curl); */
        }
    }
?>