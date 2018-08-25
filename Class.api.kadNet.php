<?php

class KadNet {

  public function getObjectByNumber($kad_number, $Comment = "Тест") {


    $kad_number = urlencode($kad_number);
    $Comment = urlencode($Comment);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/CheckNumbers?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "Query={$kad_number}&Comment={$Comment}",
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
      //echo $response;
      $response_arr = json_decode($response, true);
      return $response_arr;
    }


  }


  public function getObjectByAddress($address) {

    $address = urlencode($address);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/CheckAddress?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "Query={$address}",
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
      //echo $response;
      $response_arr = json_decode($response, true);
      return $response_arr;
    }




  }





  public function formatObjectArray($arr) {

    // Ловим ошибки
    if( !is_array($arr) || empty($arr) ) {
      return "error";
    }

    $result_array = array (
      "Id" => $arr['Data']['0']['Id'],
      "OrderId" => $arr['Data']['0']['OrderId'],
      "Number" =>  $arr['Data']['0']['Number'],
      "ObjectType" =>  $arr['Data']['0']['ObjectType'],
      "Region" =>  $arr['Data']['0']['Region']
    );

    return $result_array;



  }



  public function createRequest($objArray, $EgrnType = "ЕГРН") {



    if($EgrnType === "ЕГРН") {
      $RequestType = "EgrnObject";
    }
    elseif ($EgrnType === "ПЕРЕХОД") {
      $RequestType = "EgrnRightList";
    }
    else {
      $RequestType = "Нет данных";
    }



    $Priority = 100;
    $Comment = ($EgrnType === "ЕГРН") ? "Заказ Выписки из ЕГРН" : "Заказ Выписки о Переходе прав";;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/Create?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>
        "Id={$objArray['Id']}".
        "&OrderId={$objArray['OrderId']}".
        "&Number={$objArray['Number']}".
        "&Comment={$Comment}".
        "&Priority={$Priority}".
        "&RequestType={$RequestType}".
        "&ObjectType={$objArray['ObjectType']}".
        "&Region={$objArray['Region']}",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
      //print_r($err);
    } else {
      $response_arr = json_decode($response, true);
      return $response_arr;
    }


  }


  public function createRequestKADNET( $kad_number, $vipiska_type = "ЕГРН" ) {

    $obj_arr = $this->getObjectByNumber($kad_number);
    $obj_arr = $this->formatObjectArray($obj_arr);


    // Ловим Ошибки 1
    if(!is_array($obj_arr) || empty($obj_arr)) {
      return "error1";
      //return "Не удалось получить данные по объекту с кадастровым номером ". $kad_number;
    }

    $request_arr = $this->createRequest($obj_arr, $vipiska_type);

    // Ловим Ошибки 2
    if(!is_array($request_arr) || empty($request_arr)) {
      //return "Не удалось заказать ".$vipiska_type." с кадастровым номером ". $kad_number;
        return "error2";
    }

    // Если все окей и заказали выписку
      return $request_arr;
      //return $request_arr['Data']['Id'];


  }



  public function getInfoKADNET($Id) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/Info/{$Id}?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      //echo "cURL Error #:" . $err;
      return "error";
    } else {
      $response_arr = json_decode($response, true);
      return $response_arr;
    }



  }



  public function getStatusKADNET($Id) {

    $status_arr = $this->getInfoKADNET($Id);

    // Ловим ошибки
    if(!is_array($status_arr) || empty($status_arr)) {
      return "error";
    }

    return $status_arr['Data']['Status'];

  }


  public function getResult($Id, $Type) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.kadnet.ru/v2/Requests/Result/{$Id}?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630&Type={$Type}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "error";
    } else {
      // $response_arr = json_decode($response, true);
      return $response;
    }



  }



  public function downloadFile($URL, $PATH) {
      $ReadFile = fopen ($URL, "rb");
      if ($ReadFile) {
          $WriteFile = fopen ($PATH, "wb");
          if ($WriteFile){
              while(!feof($ReadFile)) {
                  fwrite($WriteFile, fread($ReadFile, 4096 ));
              }
              fclose($WriteFile);
          }
          fclose($ReadFile);
      }
  }


  public function downloadKADNET($orderId, $vipiska_name, $type = "pdf") {

      $URL = "https://api.kadnet.ru/v2/Requests/Result/{$orderId}?Api-Key=1657709c-7cd6-4d87-919f-1e80e4395630&Type={$type}";
      $PATH = "./files/$vipiska_name.{$type}";

      $this->downloadFile($URL, $PATH);

  }


  public function get_vipiska_name($order_arr) {
    if (
      $order_arr['Data']['RosreestrRequestType']
      ===
    "Выписка об основных характеристиках и зарегистрированных правах на объект недвижимости") {
      $vipiska_type = "ЕГРН";
    } else {
      $vipiska_type = "ПЕРЕХОД";
    }
    $kad_number = $order_arr['Data']['Number'];

    return $vipiska_type."_".str_replace(":", "_", $kad_number);
  }

  public function check_and_send_order($orderId) {
    $order_arr = $this->getInfoKADNET($orderId);

    $vipiska_name = $this->get_vipiska_name($order_arr);

    $order_status =  $order_arr['Data']['Status'];

    // Проверяем статус заказа
    if($order_status === "Завершен") {
      echo $order_status;
      $this->downloadKADNET($orderId, $vipiska_name, $type = "pdf");


    }

  }



} // end KadNet
