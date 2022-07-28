<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';

class PendingController extends Controller
{

    public function __invoke(array $request)
    {
        $templates = new League\Plates\Engine('views');

        echo $templates->render('pending');
    }


}

$controller = new PendingController();

$controller($_REQUEST);