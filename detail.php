<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';

class DetailController extends Controller
{
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        MercadoPago\SDK::setAccessToken($_ENV['MP_ACCESS_TOKEN']);
        MercadoPago\SDK::setIntegratorId($_ENV['MP_INTEGRATOR_ID']);
    }

    public function __invoke(array $request)
    {
        $preference = new MercadoPago\Preference();

        $preference->payment_methods = [
            "excluded_payment_methods" => [
                ["id" => "visa"]
            ],
            "installments" => 6
        ];

        $preference->back_urls = [
            "success" => "{$_ENV['app_url']}/success.php",
            "failure" => "{$_ENV['app_url']}/failure.php",
            "pending" => "{$_ENV['app_url']}/pending.php",
        ];

        $preference->auto_return = "approved";
        $preference->notification_url = "{$_ENV['app_url']}/ipn.php";

        $preference->external_reference = "leandro.masuero@gmail.com";

        $item = new MercadoPago\Item();
        $item->id = "1234";
        $item->title = $request['title'];
        $item->quantity = $request['quantity'];
        $item->unit_price = $request['unit_price'];
        $item->currency_id = "ARS";
        $item->description = 'Dispositivo móvil de Tienda e-commerce';
        $item->picture_url = $request['picture_url'];
        $preference->items = [$item];

        $payer = new \MercadoPago\Payer();
        $payer->name = 'Lalo';
        $payer->surname = 'Landa';
        $payer->email = 'test_user_63274575@testuser.com';
        $payer->phone = [
            "area_code" => "11",
            "number" => "4429372"
        ];

        $payer->address = [
            "street_name" => "Falsa",
            "street_number" => 123,
            "zip_code" => "3016"
        ];

        $preference->payer = $payer;

        try {
            $response = $preference->save();

            $templates = new League\Plates\Engine('views');
            echo $templates->render('detail', [
                'preferenceId' => $preference->id,
                'unitPrice' => $request['unit_price'],
                'quantity' => $request['quantity'],
                'title' => $request['title'],
                'pictureUrl' => $request['picture_url'],

                'mpPublicKey' => $_ENV['MP_PUBLIC_KEY']
            ]);


        } catch (Exception $e) {
            die($e->getMessage());
        }

    }


}

$controller = new DetailController();

$controller($_REQUEST);