<?php

declare(strict_types=1);

namespace Prototype;

use DateTime;

class User
{

}

class Status
{

}

class Order
{
    /**
     * @var float
     */
    private $sum;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct(
        float $sum,
        User $user,
        Status $status,
        DateTime $createdAt
    )
    {
        $this->sum = $sum;
        $this->user = $user;
        $this->status = $status;
        $this->createdAt = $createdAt;
    }

    /**
     * PHP встроенное клонирование. Однако, клонируются просто только
     * примитивные типы. Если какое-либо поле содержит другой объект,
     * понадобиться клонировать также и вложенные объект используя
     * такой же метод clone.
     */
    public function __clone()
    {
        $this->status = clone $this->status;
        $this->createdAt = new DateTime();
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

$order1 = new Order(500, new User(), new Status(), new DateTime());
$order2 = clone $order1;

echo 'Объекты равны: ' . ($order1 === $order2 ? 'true' : 'false') . "\n";
echo 'Суммы равны: '
    . ($order1->getSum() === $order2->getSum() ? 'true' : 'false') . "\n";
echo 'Пользователь один: '
    . ($order1->getUser() === $order2->getUser() ? 'true' : 'false') . "\n";
echo 'Статус один и тот же: '
    . ($order1->getStatus() === $order2->getStatus() ? 'true' : 'false') . "\n";
echo 'Время создания одно и то же: '
    . ($order1->getCreatedAt() === $order2->getCreatedAt() ? 'true' : 'false');