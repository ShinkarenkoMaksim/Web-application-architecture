<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class BasketBuilder implements BasketBuilderInterface
{

    /**
     * @var DiscountInterface
     */
    private $discount;
    /**
     * @var BillingInterface
     */
    private $billing;
    /**
     * @var CommunicationInterface
     */
    private $communication;
    /**
     * @var SecurityInterface
     */
    private $security;

    /**
     * @inheritDoc
     */
    public function getDiscount(): ?DiscountInterface
    {
        return $this->discount;
    }

    /**
     * @inheritDoc
     */
    public function getBilling(): ?BillingInterface
    {
        return $this->billing;
    }

    /**
     * @inheritDoc
     */
    public function getCommunication(): ?CommunicationInterface
    {
        return $this->communication;
    }

    /**
     * @inheritDoc
     */
    public function getSecurity(): ?SecurityInterface
    {
        return $this->security;
    }

    /**
     * @inheritDoc
     */
    public function setDiscount(DiscountInterface $discount): BasketBuilderInterface
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBilling(BillingInterface $billing): BasketBuilderInterface
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCommunication(CommunicationInterface $communication): BasketBuilderInterface
    {
        $this->communication = $communication;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSecurity(SecurityInterface $security): BasketBuilderInterface
    {
        $this->security = $security;
        return $this;
    }

}