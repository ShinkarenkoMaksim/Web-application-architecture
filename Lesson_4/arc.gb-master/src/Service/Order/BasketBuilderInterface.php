<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

interface BasketBuilderInterface
{
    /**
     * @return DiscountInterface
     */
    public function getDiscount(): ?DiscountInterface;

    /**
     * @return BillingInterface
     */
    public function getBilling(): ?BillingInterface;

    /**
     * @return CommunicationInterface
     */
    public function getCommunication(): ?CommunicationInterface;

    /**
     * @return SecurityInterface|null
     */
    public function getSecurity(): ?SecurityInterface;

    /**
     * @param DiscountInterface $discount
     * @return $this
     */
    public function setDiscount(DiscountInterface $discount): self ;

    /**
     * @param BillingInterface $billing
     * @return $this
     */
    public function setBilling(BillingInterface $billing): self ;

    /**
     * @param CommunicationInterface $communication
     * @return $this
     */
    public function setCommunication(CommunicationInterface $communication): self ;

    /**
     * @param SecurityInterface $security
     * @return $this
     */
    public function setSecurity(SecurityInterface $security): self ;

}