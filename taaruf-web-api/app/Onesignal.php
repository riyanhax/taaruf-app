<?php
namespace app;

class Onesignal {

    function sendPushnotification($player_id,$message) {
        $content = array(
            "en" => $message
            );
        
        $fields = array(
            'app_id' => "fd6a3860-96e6-4144-aed0-1bf1af246ba9",
            'include_player_ids' => array($player_id),
            //'data' => array('id_order' => $no_order),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utc+8',
                                                   'Authorization: Basic NjU4YWQ1ZTEtY2I5OC00ZmJmLWI2M2EtMGI0NTI3ZTc3N2Yz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
    }
}
?>