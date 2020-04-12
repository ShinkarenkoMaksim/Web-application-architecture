<?php

declare(strict_types = 1);

namespace Service\Product;

use Exception;
use Model;
use Model\Entity\Product;
use Model\Repository\ProductRepository;
use Service\Comparator\ComparatorInterface;

class ProductService
{
    /**
     * Получаем информацию по конкретному продукту
     * @param int $id
     * @return Product|null
     */
    public function getInfo(int $id): ?Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем все продукты
     * @param string $sortType
     * @return Product[]
     */
    public function getAll(string $sortType): array
    {
        $productList = $this->getProductRepository()->fetchAll();

        // Применить паттерн Стратегия
        if ($sortType !== '') {
            //Не знаю, насколько грамотное решение, но придумал от if ... else отказаться таким образом, хотя это и
            //накладывает обязательства следить за правильным вводом. Зато при дальнейшем расширении не придется
            //править данный класс, добавляя сколько угодно сортировок
            $controllerName = '\\Service\\Comparator\\' . ucfirst($sortType) . 'Comparator';
            if (class_exists($controllerName))
                return $this->sort($productList, new $controllerName);
            else
                return $productList;
        }

        return $productList;
    }

    /**
     * @param array $productList
     * @param ComparatorInterface $comparator
     * @return array
     */
    protected function sort(array $productList, ComparatorInterface $comparator): array
    {
        usort($productList, [$comparator, 'compare']);

        return $productList;
    }

    /**
     * Фабричный метод для репозитория Product
     * @return ProductRepository
     */
    protected function getProductRepository(): ProductRepository
    {
        return new ProductRepository();
    }
}
