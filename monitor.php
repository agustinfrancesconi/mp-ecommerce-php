<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';


class MonitorController extends Controller
{
    public function __invoke(array $request): void
    {
        if (file_exists("info.log")) {
            echo file_get_contents("info.log");
        } else {
            echo "sin actividad...";
        }
    }

}

$controller = new MonitorController();

$controller($_REQUEST);