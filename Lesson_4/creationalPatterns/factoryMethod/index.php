<?php

declare(strict_types=1);

namespace FactoryMethod;

use FactoryMethod\Contract\BaseBanner;
use FactoryMethod\Entity\ImageBanner;
use FactoryMethod\Entity\TextBanner;

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $className = preg_replace('/^FactoryMethod/', '', $className);
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
});

/**
 * @var BaseBanner[] $banners
 * Такую пачку баннеров можно передать для вывода, это массив BaseBanner, то
 * есть мы не указываем какие это баннеры, но мы указываем что у всех их будет
 * метод show, с помощью которого можно в данном случае что-то вывести.
 */
$banners = [
    new ImageBanner('/assets/bannerImage.jpg'),
    new TextBanner('Продающий текст баннера.')
];

// Выводим баннеры.
foreach ($banners as $banner) {
    $banner->show();
}