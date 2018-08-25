<?php


$address = urlencode("Москва, ул Знаменские Садки, д 1, корп 1, кв 139");




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/CheckAddress?Api-Key=165375ff-dc30-48f5-99d4-63b7b94b7ffc",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "Query={$address}&Comment=%D1%82%D0%B5%D1%81%D1%82%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%BF%D1%80%D0%BE%D0%B3%D0%BE%D0%BD",
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
//  echo $response;
}



  $response_arr = json_decode($response, true);





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
