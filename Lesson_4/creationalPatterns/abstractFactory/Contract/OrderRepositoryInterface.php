<?php

declare(strict_types=1);

namespace AbstractFactory\Contract;

use AbstractFactory\Entity\Order;

/**
 * Interface OrderRepositoryInterface Интерфейс описывающий как должен работать
 * репозиторий по управлению заказами. Здесь нет упоминания о том, куда мы
 * будем сохранять заказ, здесь определены лишь методы для работы с заказом.
 * Куда сохранять эти заказы будет решает тот класс, который будет этот
 * интерфейс реализовывать.
 * @package Contract
 */
interface OrderRepositoryInterface
{
    /**
     * @param Order $order
     * @return void
     */
    public function add(Order $order);

    /**
     * @param Order $order
     * @return void
     */
    public function delete(Order $order);

    /**
     * @param Order $order
     * @return void
     */
    public function update(Order $order);
}