<?php

declare(strict_types=1);

namespace Setono\TagBag\Tag;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Setono\TagBag\Tag\PhpTemplatesTag
 */
final class PhpTemplatesTagTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates(): void
    {
        $tag = self::getTag();

        $this->assertInstanceOf(TagInterface::class, $tag);
        $this->assertInstanceOf(PhpTemplatesTagInterface::class, $tag);
    }

    /**
     * @test
     */
    public function it_has_default_values(): void
    {
        $tag = self::getTag();

        $this->assertSame('setono_tag_bag_php_templates_tag', $tag->getName());
        $this->assertSame('template', $tag->getTemplate());
        $this->assertIsArray($tag->getContext());
        $this->assertCount(0, $tag->getContext());
    }

    /**
     * @test
     */
    public function it_is_mutable(): void
    {
        $tag = self::getTag();
        $tag->setContext(['key' => 'value']);

        $this->assertSame(['key' => 'value'], $tag->getContext());
    }

    /**
     * @test
     */
    public function it_adds_parameters(): void
    {
        $tag = self::getTag();
        $tag->setContext(['key1' => 'value1']);
        $tag->addContext('key2', 'value2');

        $this->assertSame(['key1' => 'value1', 'key2' => 'value2'], $tag->getContext());
    }

    private static function getTag(): PhpTemplatesTag
    {
        return new PhpTemplatesTag('template');
    }
}
