<?php

declare(strict_types=1);

namespace Builder\Director;

use Builder\Contract\OrderBuilderInterface;
use Builder\Entity\Invoice;
use Builder\Entity\Order;
use Builder\Entity\Payment;
use Builder\Entity\User;

class Director
{
    /**
     * @param OrderBuilderInterface $builder
     */
    public function constructNewOrder(OrderBuilderInterface $builder): void
    {
        $builder->setInvoice(new Invoice())
            ->setPayment(new Payment())
            ->setUser(new User())
            ->setStatus(Order::STATUS_NEW);
    }

    /**
     * @param OrderBuilderInterface $builder
     */
    public function constructRejectedOrder(OrderBuilderInterface $builder): void
    {
        $builder->setInvoice(new Invoice())
            ->setPayment(new Payment())
            ->setUser(new User())
            ->setStatus(Order::STATUS_REJECTED);
    }
}