<?php
    // SDK de Mercado Pago
    require __DIR__ .  '/vendor/autoload.php';
    // Agrega credenciales
    MercadoPago\SDK::setAccessToken('TEST-7927930363733040-091820-ab37d1bec3f64e917b72e51f505988d1-150229622');

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    $preference->payment_methods = array(
        "excluded_payment_methods" => array(
          array("id" => "master")
        ),
        "excluded_payment_types" => array(
          array("id" => "ticket")
        ),
        "installments" => 12
    );

    $item = new MercadoPago\Item();
    $item->title = $_POST['title'];
    $item->quantity = $_POST['unit'];
    $item->unit_price = $_POST['price'];
    $preference->items = array($item);
    $preference->save();
?>