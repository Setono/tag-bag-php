<?php

declare(strict_types=1);

namespace Setono\TagBag\Renderer;

use Setono\PhpTemplates\Engine\EngineInterface;
use Setono\TagBag\Tag\PhpTemplatesTagInterface;
use Setono\TagBag\Tag\TagInterface;

final class PhpTemplatesRenderer implements RendererInterface
{
    /** @var EngineInterface */
    private $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function supports(TagInterface $tag): bool
    {
        return $tag instanceof PhpTemplatesTagInterface;
    }

    /**
     * @param PhpTemplatesTagInterface|TagInterface $tag
     */
    public function render(TagInterface $tag): string
    {
        return $this->engine->render($tag->getTemplate(), $tag->getContext());
    }
}
