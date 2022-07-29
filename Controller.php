<?php

class Controller
{

    public function redirect(string $url, int $statusCode = 303): void
    {
        header("Location: {$url}", true, $statusCode);
        die();
    }

    public function log(string $level, $data): void
    {
        file_put_contents("$level.log", json_encode($data), FILE_APPEND);
    }

}