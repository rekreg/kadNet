<?php

$Id =
$OrderId =
$Priority =
$ObjectType = 
$kad_number = urlencode("77:06:0011003:2158");




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/Create?Api-Key=dbb034e3-059e-4151-95dd-69850dba7dae",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "Id=75a79425-5c52-4d47-b69a-6416192a969e&OrderId=c067ed89-607f-4cd0-8b53-43658dc0688d&Number=66%3A06%3A4501018%3A2131&Comment=%D1%82%D0%B5%D1%81%D1%82%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%BF%D1%80%D0%BE%D0%B3%D0%BE%D0%BD&Priority=80&RequestType=EgrnRightList&ObjectType=1288670c-4a52-4ec7-b11b-a7ccdcc6c72f&Region=66",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}



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

  </body>
</html>
