<?php

namespace App\Service;

use App\Entity\LinkedList;
use App\Entity\Node;

class LinkedListService
{
    protected ?LinkedList $linkedList;

    public function setLinkedList(?LinkedList $linkedList): self
    {
        $this->linkedList = $linkedList;

        return $this;
    }

    public function getLinkedList(): ?LinkedList
    {
        return $this->linkedList;
    }

    public function addNode(Node $node): self
    {
        $head = $this->linkedList->getHead();

        if ($head === null || $head->getValue() >= $node->getValue()) {
            $node->setNextNode($head);
            $this->linkedList->setHead($node);
        }

        return $this;
    }
}
