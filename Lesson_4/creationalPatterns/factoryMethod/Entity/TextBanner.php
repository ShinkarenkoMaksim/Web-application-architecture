<?php

declare(strict_types=1);

namespace FactoryMethod\Entity;

use FactoryMethod\Contract\BaseBanner;

class TextBanner extends BaseBanner
{
    /**
     * @var string
     */
    private $text;

    /**
     * TextBanner constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function prepareHTML(): string
    {
        return 'Текстовый баннер с текстом "' . $this->text . '"'. PHP_EOL;
    }
}