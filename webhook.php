<?php

require './app_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $data = json_decode(file_get_contents('php://input'),true);
    function CurlSendPostRequest($url,$request,$headers){
        $ch = curl_init($url);
        $options = array(CURLOPT_HTTPHEADER => $headers, CURLOPT_POSTFIELDS => $request,CURLOPT_RETURNTRANSFER=>TRUE);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);
        $decoded =  json_decode((string)$data,true);
        return $decoded;
        }
    
    // Globals
    $headers = array(
        "Authorization: Bearer $api_key",
        "Content-Type: application/json"
    );
    $x= array('mailid'=>$data["member"]["email"],'fileid'=>$data["member"]["fileObjects"][0]["file"]["id"]);
    $domain = $_SERVER['HTTP_HOST'];
    $prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $var = CurlSendPostRequest($prefix.$domain.'/mail.php',json_encode($x),$headers);
    echo "success";
}

?>