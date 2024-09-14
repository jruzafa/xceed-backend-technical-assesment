<?php

declare(strict_types=1);

namespace Xceed\Tweet\Domain;

use Traversable;

final class TweetCollection implements \IteratorAggregate, \Countable
{
    private array $elements = [];

    public function add(Tweet $element): void
    {
        $this->elements[(string) $element->text()] = $element;
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function remove(Tweet $element): void
    {
        unset($this->elements[(string) $element->text()]);
    }

    public function contains($element): bool
    {
        return isset($this->elements[(string) $element->text()]);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
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
}