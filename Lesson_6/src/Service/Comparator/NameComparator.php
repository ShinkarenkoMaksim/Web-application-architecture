<?php

declare(strict_types = 1);

namespace Service\Comparator;


use Model\Entity\Product;

class NameComparator implements ComparatorInterface
{
    /**
     * @param Product $productA
     * @param Product $productB
     * @return int
     */
    public function compare($productA, $productB): int
    {
        return $productA->getName() <=> $productB->getName();
    }
}