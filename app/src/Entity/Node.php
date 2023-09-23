<?php

namespace App\Entity;

class Node
{
    protected ?int $intValue = null;
    protected ?string $stringValue = null;
    protected ?Node $nextNode = null;

    public function setIntValue(int $value): self
    {
        $this->intValue = $value;

        return $this;
    }

    public function setStringValue(string $value): self
    {
        $this->stringValue = $value;

        return $this;
    }

    public function getValue(): string|int
    {
        return $this->stringValue ?? $this->intValue;
    }

    public function hasIntegerValue(): bool
    {
        return $this->intValue !== null;
    }

    public function setNextNode(?Node $nextNode): self
    {
        $this->nextNode = $nextNode;

        return $this;
    }

    public function getNextNode(): ?Node
    {
        return $this->nextNode;
    }
}
