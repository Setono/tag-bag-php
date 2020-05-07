<?php

declare(strict_types=1);

namespace Setono\TagBag\Renderer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Setono\PhpTemplates\Engine\EngineInterface;
use Setono\TagBag\Tag\Tag;
use Setono\TagBag\Tag\PhpTag;

/**
 * @covers \Setono\TagBag\Renderer\PhpRenderer
 */
final class PhpRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_supports_php_tag_interface(): void
    {
        $renderer = new PhpRenderer($this->getEngine());

        $this->assertTrue($renderer->supports(new PhpTag('key', 'template')));
    }

    /**
     * @test
     */
    public function it_does_not_support_tag_interface(): void
    {
        $renderer = new PhpRenderer($this->getEngine());

        $this->assertFalse($renderer->supports(new Tag('key')));
    }

    /**
     * @test
     */
    public function it_renders(): void
    {
        $env = $this->getEngine();
        $env
            ->method('render')
            ->with('template', ['context_key' => 'context_value'])
            ->willReturn('content')
        ;

        $renderer = new PhpRenderer($env);

        $tag = (new PhpTag('key', 'template'))
            ->addContext('context_key', 'context_value')
        ;

        $this->assertSame('content', $renderer->render($tag));
    }

    /**
     * @return EngineInterface|MockObject
     */
    private function getEngine(): EngineInterface
    {
        return $this->createMock(EngineInterface::class);
    }
}
