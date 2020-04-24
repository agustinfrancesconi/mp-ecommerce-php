<?php

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

$access_token = 'APP_USR-1641504150081992-042421-bad4039833cf18115fbc450f8e83e68c-469485398';
$payment_id = $_POST["payment_id"];

$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/$payment_id?access_token=$access_token");
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($cURLConnection);
curl_close($cURLConnection);

$jsonResponse = json_decode($response);

$order_id = $jsonResponse->order->id;
$payment_method_id = $jsonResponse->payment_method_id;
$transaction_amount = $jsonResponse->transaction_amount;

?>

<html lang="en">
<head>
</head>
<body style="background: green">
  Estado del pago: aprobado
  <br>
  <br>
  ID de pago de MercadoPago: <?= $payment_id ?>
<br>
  Número de órden del pedido: <?= $order_id ?>
  <br>
  payment_method_id: <?= $payment_method_id ?>
  <br>
  Monto pagado: <?= $transaction_amount ?>
  </body>
</html>