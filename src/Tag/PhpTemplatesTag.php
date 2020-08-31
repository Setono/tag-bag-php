<?php

declare(strict_types=1);

namespace Setono\TagBag\Tag;

class PhpTemplatesTag extends TemplateTag implements PhpTemplatesTagInterface
{
    /** @var string */
    protected $name = 'setono_tag_bag_php_templates_tag';

    /**
     * @param mixed $value
     */
    public function addContext(string $key, $value): self
    {
        $this->context[$key] = $value;

        return $this;
    }
}
