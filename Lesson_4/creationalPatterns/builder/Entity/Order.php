<?php

declare(strict_types=1);

namespace Builder\Entity;

use Builder\Contract\OrderBuilderInterface;

class Order
{
    public const STATUS_NEW = 'new';
    public const STATUS_PAYED = 'payed';
    public const STATUS_REJECTED = 'rejected';

    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $status;

    /*
    // Вместо такого конструктора можно использовать более лаконичный (ниже).
    public function __construct(
        Invoice $invoice,
        Payment $payment,
        User $user,
        $status
    ) {
        $this->invoice = $invoice;
        $this->payment = $payment;
        $this->user = $user;
        $this->status = $status;
    }
    */

    public function __construct(OrderBuilderInterface $builder)
    {
        $this->invoice = $builder->getInvoice();
        $this->payment = $builder->getPayment();
        $this->user = $builder->getUser();
        $this->status = $builder->getStatus();
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}