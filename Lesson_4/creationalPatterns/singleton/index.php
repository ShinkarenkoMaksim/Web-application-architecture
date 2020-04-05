<?php

declare(strict_types=1);

namespace Singleton;

use Exception;

class Singleton
{
    /**
     * Здесь будет храниться экземпляр класса.
     */
    private static $instance;

    /**
     * Закрываем конструктор
     */
    private function __construct() { }

    /**
     * Закрываем клонирование
     */
    private function __clone() { }

    /**
     * Закрываем восстановление из строк (десериализации).
     */
    private function __wakeup() { }

    /**
     * Статический метод, который будет отдавать экземпляр данного класса.
     * Только через этот метод можно получить экземпляр класса, все остальные
     * возможности закрыты.
     */
    public static function getInstance(): Singleton
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Логика нашего класса может быть реализована в других методах.
     */
    public function logic()
    {
        echo 'Логика нашего единого Singleton-класса.' . PHP_EOL;
    }
}


$s1 = Singleton::getInstance();
$s1->logic();

$s2 = Singleton::getInstance();
$s2->logic();

if ($s1 === $s2) {
    echo 'Обе переменные содержат в себе один и тот же экземпляр.' . PHP_EOL;
}