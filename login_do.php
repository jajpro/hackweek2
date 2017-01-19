<?php

  ob_start();
  session_start();

  if($_SESSION['access_token'] == null) {
    echo "<script>location.href="."'".index.'.'.php."';</script>";
  } 

  // 네이버 로그인 콜백 예제
  $client_id = "WCE0_RqO7EjPIszSHpBe";
  $client_secret = "jYTHP_rZq_";
  $code = $_GET["code"];;
  $state = $_GET["state"];;
  $redirectURI = urlencode("http://jaj78844.cafe24.com/hackweek2/login_do.php");
  //$redirectURI = urlencode("http://jaj78844.cafe24.com/hackweek/login_do.php");
  $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  $headers = array();
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);

  $array = json_decode($response, true);


  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }

  $_SESSION['access_token'] =  $array['access_token'];

  $token = $_SESSION['access_token'];
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/v1/nid/me";
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  
  $headers = array();
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }

  $array = json_decode($response, true);

  $_SESSION['email'] = $array['response']['email'];

  echo "<script>location.href="."'".index.'.'.php."';</script>";


?>