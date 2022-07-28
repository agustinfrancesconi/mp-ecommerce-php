<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';

class FailureController extends Controller
{

    public function __invoke(array $request)
    {
        $templates = new League\Plates\Engine('views');

        echo $templates->render('failure');
    }


}

$controller = new FailureController();

$controller($_REQUEST);