<?php

require_once 'Class.api.kadNet.php';

$KadNet = new KadNet;

$kad_number = "78:14:0007680:9246";

//$address = "г Москва, ул Знаменские Садки, д 1 к 1, кв 139";


//$response_arr = $KadNet->getObjectByNumber($kad_number);


//$response_arr = $KadNet->getObjectByAddress($address);


//$response_arr = $KadNet->formatObjectArray($response_arr);


//$response_arr = $KadNet->createRequest($response_arr, "ПЕРЕХОД");

//$response_arr = $KadNet->createRequestKADNET( $kad_number, "ПЕРЕХОД" );




////////////////// ЕГРН ///////////////////////
//$response_arr = $KadNet->getInfoKADNET("cc23088c-da45-4745-9169-71646a570b3c");


////////////////// ПЕРЕХОД ///////////////////////
$response_arr = $KadNet->getInfoKADNET("5b8f4595-b434-4785-b365-1ccb5c57a21d");







//$result_link = $KadNet->getResult("cc23088c-da45-4745-9169-71646a570b3c", "pdf");

//
//
//

//
// downloadFile ("https://api.kadnet.ru/v2/Requests/Result/16d95320-ffac-4610-bb28-637e77106e63?Api-Key=dbb034e3-059e-4151-95dd-69850dba7dae&Type=pdf", "./files/file.pdf");



$KadNet->check_and_send_order("5b8f4595-b434-4785-b365-1ccb5c57a21d");

 ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <pre>
    <?php print_r($response_arr); ?>
  </pre>

  <hr>

  <pre>
    <?php
    // print_r($info_arr);
     ?>
  </pre>

  <hr>

  <pre>

  </pre>

  </body>
</html>
