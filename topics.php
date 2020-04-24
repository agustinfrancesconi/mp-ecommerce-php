<?php

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

MercadoPago\SDK::setAccessToken("APP_USR-1641504150081992-042421-bad4039833cf18115fbc450f8e83e68c-469485398");

$type = isset($_GET["type"]) ? $_GET["type"] : isset($_POST["type"]) ? $_POST["type"] : null;
$id = isset($_GET["id"]) ? $_GET["id"] : isset($_POST["id"]) ? $_POST["id"] : null;

switch ($type) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($id);
        if (!empty($payment)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($id);
        if (!empty($plan)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 NOT_OK");
        }
        break;
    default:
        header("HTTP/1.1 200 OK");
        break;
}
