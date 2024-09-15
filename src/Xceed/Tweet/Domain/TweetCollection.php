<?php

declare(strict_types=1);

namespace Xceed\Tweet\Domain;

use Traversable;

final class TweetCollection implements \IteratorAggregate, \Countable, \ArrayAccess
{
    private array $elements = [];

    public function __construct(array $elements = [])
    {
        foreach ($elements as $element) {
            if (!$element instanceof Tweet) {
                throw new \InvalidArgumentException('Only Tweet objects are allowed');
            }

            $this->add($element);
        }
    }

    public function add(Tweet $element): void
    {
        $this->elements[(string) $element->text()] = $element;
    }

    public function toArray(): array
    {
        $elements = [];

        foreach ($this->elements as $element) {
            $elements[] = $element->toArray();
        }

        return $elements;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->elements);
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->elements[(string) $offset->text()]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->elements[(string) $offset->text()];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->elements[(string) $offset->text()] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->elements[(string) $offset->text()]);
    }
}