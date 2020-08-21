<?php
$nombre =  $cantidad = $precio = $img = NULL;

if(isset($_POST['enviar'])) {
   $nombre = $_POST['title'];
   $cantidad = $_POST['unit'];
   $precio = $_POST['price'];
   $img = $_POST['img'];

}

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = 1234;
$item->title = $nombre;
$item->description = "Dispositivo móvil de Tienda e-commerce";
$item->quantity = $cantidad;
$item->unit_price = $precio;
$item->picture_url = $img;

$preference->items = array($item);

// Excluir AMEX y poder pagar solo en 6 cuotas.
$preference->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
  "installments" => 6
);

// Agrego datos del pagador
$payment = new MercadoPago\Payer();
$payment->name = "Lalo";
$payment->surname = "Landa";
$payment->email = "joaquindaneri@gmail.com";

$payment->phone = array (
	"area_code" => "11",
	"number" => "22223333"
);

$payment->address = array (
	"street_name" => "False",
	"street_number" => "123",
	"zip_code" => "1111"
);
$preference->payment = array($payment);

$preference->external_reference = "joaquindaneri@gmail.com";

$preference->back_urls = array(
    "success" => "https://certificado-mercadopago.herokuapp.com/aprobado.php",
    "failure" => "https://certificado-mercadopago.herokuapp.com/rechazado.php",
    "pending" => "https://certificado-mercadopago.herokuapp.com/pendiente.php"
);
$preference->auto_return = "approved";

$preference->save();

?>
<form action="/procesar-pago" method="POST">
  <script
   src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
   data-preference-id="<?php echo $preference->id; ?>">
  </script>
</form>
