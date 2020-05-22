<?php

declare(strict_types=1);

namespace Setono\TagBag\Tag;

interface PhpTemplatesTagInterface extends TagInterface
{
    /**
     * Returns the PHP template
     */
    public function getTemplate(): string;

    /**
     * Returns the context to inject into the php template when rendered
     */
    public function getContext(): array;
}
