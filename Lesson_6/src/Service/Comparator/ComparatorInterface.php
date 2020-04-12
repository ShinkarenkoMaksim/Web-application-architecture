<?php

declare(strict_types = 1);

namespace Service\Comparator;


use Model\Entity\Product;

interface ComparatorInterface
{
    /**
     * @param Product $productA
     * @param Product $productB
     * @return int
     */
    public function compare($productA, $productB);
}