<?php

declare(strict_types=1);

namespace Setono\TagBag\Renderer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Setono\PhpTemplates\Engine\EngineInterface;
use Setono\TagBag\Tag\PhpTemplatesTag;
use Setono\TagBag\Tag\Tag;

/**
 * @covers \Setono\TagBag\Renderer\PhpTemplatesRenderer
 */
final class PhpTemplatesRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_supports_php_tag_interface(): void
    {
        $renderer = new PhpTemplatesRenderer($this->getEngine());

        $this->assertTrue($renderer->supports(self::getTag()));
    }

    /**
     * @test
     */
    public function it_does_not_support_tag_interface(): void
    {
        $renderer = new PhpTemplatesRenderer($this->getEngine());

        $this->assertFalse($renderer->supports(new class() extends Tag {
        }));
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

        $renderer = new PhpTemplatesRenderer($env);

        $tag = (self::getTag())
            ->addContext('context_key', 'context_value')
        ;

        $this->assertSame('content', $renderer->render($tag));
    }

    private static function getTag(): PhpTemplatesTag
    {
        return new PhpTemplatesTag('template');
    }

    /**
     * @return EngineInterface|MockObject
     */
    private function getEngine(): EngineInterface
    {
        return $this->createMock(EngineInterface::class);
    }
}
