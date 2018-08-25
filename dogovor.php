<?php

require_once 'Class.api.kadNet.php';

$KadNet = new KadNet;

$kad_number = "77:05:0008001:4327";


$response_arr = $KadNet->getObjectByNumber($kad_number);

//$response_arr = $KadNet->dogovorPrepare($response_arr);


//$response_arr = $KadNet->createRequestKADNET( $kad_number, "ПЕРЕХОД" );
//$request_arr = $KadNet->createRequest($response_arr, "ЕГРН");

//$response_arr = $KadNet->getInfo("2daa6052-f7f8-46a2-9e5c-3c8c2b42a775");

//$result_link = $KadNet->getResult("16d95320-ffac-4610-bb28-637e77106e63", "pdf");

//
//
//
// function downloadFile ($URL, $PATH) {
//     $ReadFile = fopen ($URL, "rb");
//     if ($ReadFile) {
//         $WriteFile = fopen ($PATH, "wb");
//         if ($WriteFile){
//             while(!feof($ReadFile)) {
//                 fwrite($WriteFile, fread($ReadFile, 4096 ));
//             }
//             fclose($WriteFile);
//         }
//         fclose($ReadFile);
//     }
// }
//
// downloadFile ("https://api.kadnet.ru/v2/Requests/Result/16d95320-ffac-4610-bb28-637e77106e63?Api-Key=dbb034e3-059e-4151-95dd-69850dba7dae&Type=pdf", "./files/file.pdf");


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
