<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function send(){
      $device = [
        'cdFbG8WrdZCDPFWe7JZN0h:APA91bGkw_CF7glIthMu4sPNbGSqF2HWDt0oGsxBhCtI3m7l_jVA2PNuTg0jK-HRUz7hKpqL0X34dGx_aRj7g-Uu4VUhwrQCZ_RTG2Sar51SuFwX9boIyJLzIgASkonGQbDH52LXhrw7'
      ];
      $data = array(
        "registration_ids" => $device,            // for multiple devices
         "notification" => array(
         "title" => "Party Night",
         "body" => "Invitation for pool party!",
         "message"=>"Come at evening...",
         'icon'=>'https://www.example.com/images/icon.png'
     ),
         "data"=>array(
         "name"=>"xyz",
         'image'=>'https://www.example.com/images/minion.jpg'
         )
     );

    $data_string = json_encode($data);
    $API_ACCESS_KEY =env('FCM_SERVER_KEY');
    $headers = array
    (
        'Authorization: key=' . $API_ACCESS_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
    $result = curl_exec($ch );
    curl_close( $ch );
    return $result;
    }
}
