<?php

declare(strict_types=1);

namespace Builder\Builder;

use Builder\Contract\OrderBuilderInterface;
use Builder\Entity\Invoice;
use Builder\Entity\Order;
use Builder\Entity\Payment;
use Builder\Entity\User;

class OrderBuilder implements OrderBuilderInterface
{
    /**
     * @var ?Invoice
     */
    private $invoice;

    /**
     * @var ?Payment
     */
    private $payment;

    /**
     * @var ?User
     */
    private $user;

    /**
     * @var ?string
     */
    private $status;

    /**
     * @return Invoice
     */
    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    /**
     * @return Payment
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
       return $this->user;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
       return $this->status;
    }

    /**
     * @param Invoice $invoice
     * @return OrderBuilderInterface
     */
    public function setInvoice(Invoice $invoice): OrderBuilderInterface
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * @param Payment $payment
     * @return OrderBuilderInterface
     */
    public function setPayment(Payment $payment): OrderBuilderInterface
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @param User $user
     * @return OrderBuilderInterface
     */
    public function setUser(User $user): OrderBuilderInterface
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $status
     * @return OrderBuilderInterface
     */
    public function setStatus(string $status): OrderBuilderInterface
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Order
     */
    public function build(): Order
    {
        return new Order($this);
    }
}