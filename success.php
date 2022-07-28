<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';

class SuccessController extends Controller
{

    public function __invoke(array $request)
    {
        $templates = new League\Plates\Engine('views');

        echo $templates->render('success', [
            'collectionId' => $request['collection_id'],
            'collectionStatus' => $request['collection_status'],
            'paymentId' => $request['payment_id'],
            'status' => $request['status'],
            'externalReference' => $request['external_reference'],
            'paymentType' => $request['payment_type'],
            'merchantOrderId' => $request['merchant_order_id'],
            'preferenceId' => $request['preference_id'],
        ]);
    }


}

$controller = new SuccessController();

$controller($_REQUEST);