<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Controller.php';


class IpnController extends Controller
{
    public function __invoke(array $request): void
    {
        $json = file_get_contents('php://input');
        $data = array_merge($request, json_decode($json, true));

        $this->log('info', $data);

        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit();
    }

}

$controller = new IpnController();

$controller($_REQUEST);