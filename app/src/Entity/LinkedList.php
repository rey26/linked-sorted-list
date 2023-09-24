<?php

namespace App\Entity;

class LinkedList
{
    protected ?Node $head = null;

    public function setHead(?Node $head): self
    {
        $this->head = $head;

        return $this;
    }

    public function getHead(): ?Node
    {
        return $this->head;
    }
}
