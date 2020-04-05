<?php

declare(strict_types=1);

namespace FactoryMethod\Entity;

use FactoryMethod\Contract\BaseBanner;

class ImageBanner extends BaseBanner
{
    /**
     * @var string
     */
    private $src;

    /**
     * ImageBanner constructor.
     * @param string $src
     */
    public function __construct(string $src)
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function prepareHTML(): string
    {
        return 'Баннер с картинкой, url: "' . $this->src . '"' . PHP_EOL;
    }
}