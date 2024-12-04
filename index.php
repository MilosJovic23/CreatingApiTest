<?php

    declare(strict_types=1);


    spl_autoload_register(function ($class) {
        require __DIR__ . "/src/$class.php";
    });

    set_exception_handler("ErrorHandler::handleException");

    header("Content-Type: application/json,charset=utf-8");

    $parts = explode("/",$_SERVER["REQUEST_URI"] );

    $database = new Database("localhost", "root", "root", "");

    $database->getConnection();


    if (  $parts[2] !== "products") {
        http_response_code(404);
        exit;
    }

    $id = $parts[3] ?? null;

    $controller = new ProductController();
    $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);


?>