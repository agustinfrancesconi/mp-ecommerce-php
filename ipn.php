<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';


class IpnController extends Controller
{
    public function __invoke(array $request): void
    {
        $this->log('info', $request);
    }

}

$controller = new IpnController();

$controller($_REQUEST);