<?php


namespace Facade;


use Service\Billing\BillingInterface;
use Service\Billing\Exception\BillingException;
use Service\Communication\CommunicationInterface;
use Service\Communication\Exception\CommunicationException;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class CheckoutFacade
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
     * @var SecurityInterface
     */
    private $security;
    /**
     * @var CommunicationInterface
     */
    private $communication;

    /**
     * CheckoutFacade constructor.
     * @param DiscountInterface $discount
     * @param BillingInterface $billing
     * @param SecurityInterface $security
     * @param CommunicationInterface $communication
     */
    public function __construct(
        DiscountInterface $discount,
        BillingInterface $billing,
        SecurityInterface $security,
        CommunicationInterface $communication
    )
    {
        $this->discount = $discount;
        $this->billing = $billing;
        $this->security = $security;
        $this->communication = $communication;
    }

    /**
     * @param $price
     * @throws BillingException
     * @throws CommunicationException
     */
    public function checkoutProcess($price)
    {
        $discount = $this->discount->getDiscount();
        $price = $price - $price / 100 * $discount;

        $this->billing->pay($price);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }

}