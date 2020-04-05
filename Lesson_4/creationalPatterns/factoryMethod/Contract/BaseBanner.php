<?php

declare(strict_types=1);

namespace FactoryMethod\Contract;

abstract class BaseBanner
{
    /**
     * Фабричный метод. Этот метод будет что-то создавать, в данном случае - это
     * строка HTML баннера, но чаще всего создается какой-то класс, который
     * используется для работы нашего класса.
     * @return string
     */
    abstract public function prepareHTML(): string;

    /**
     * Показываем баннер.
     */
    public function show(): void
    {
        echo $this->prepareHTML();
    }
}