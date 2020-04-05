<?php

declare(strict_types=1);

namespace Builder;

use Builder\Builder\OrderBuilder;
use Builder\Director\Director;

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $className = preg_replace('/^Builder/', '', $className);
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
});

// Создаем директора, который знает как строить заказы.
$director = new Director();

// Создаем нового строителя заказов.
$orderBuilder = new OrderBuilder();
// Просим директора, чтоб он создал новый заказ.
$director->constructNewOrder($orderBuilder);
// Получаем от строителя новый заказ.
$order = $orderBuilder->build();
// Выводим статус заказа (для примера).
echo 'Status of product is: ' . $order->getStatus() . PHP_EOL;

// Создаем нового строителя заказов.
$orderBuilder = new OrderBuilder();
// Просим директора, чтоб он создал отмененный заказ.
$director->constructRejectedOrder($orderBuilder);
// Получаем от строителя новый заказ.
$order = $orderBuilder->build();
// Выводим статус заказа (для примера).
echo 'Status of product is: ' . $order->getStatus() . PHP_EOL;