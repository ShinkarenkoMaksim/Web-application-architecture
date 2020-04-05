<?php


namespace Service\Order;


use Service\Billing\Exception\BillingException;
use Service\Communication\Exception\CommunicationException;

class CheckoutProcess
{

    /**
     * Проведение всех этапов заказа
     * @param BasketBuilderInterface $basketBuilder
     * @param array $products
     * @return void
     * @throws BillingException
     * @throws CommunicationException
     */
    public function checkoutProcess(BasketBuilderInterface $basketBuilder, array $products): void
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $basketBuilder->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $basketBuilder->getBilling()->pay($totalPrice);

        $user = $basketBuilder->getSecurity()->getUser();
        $basketBuilder->getCommunication()->process($user, 'checkout_template');
    }

}