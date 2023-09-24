<?php

namespace App\Service;

use App\Entity\LinkedList;
use App\Entity\Node;

class LinkedListService
{
    protected ?LinkedList $linkedList = null;

    public function setLinkedList(LinkedList $linkedList): self
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
        } else {
            $current = $head;

            while ($current->getNextNode() !== null && $current->getNextNode()->getValue() < $node->getValue()) {
                $current = $current->getNextNode();
            }
            $node->setNextNode($current->getNextNode());
            $current->setNextNode($node);
        }

        return $this;
    }

    public function getFirstNode(): ?Node
    {
        return $this->linkedList?->getHead();
    }

    public function getLastNode(): ?Node
    {
        if ($this->linkedList?->getHead() === null) {
            return null;
        }
        $current = $this->linkedList->getHead();

        while ($current->getNextNode() !== null) {
            $current = $current->getNextNode();
        }

        return $current;
    }

    public function removeNode(Node $node): self
    {
        if ($this->linkedList->getHead() !== null) {
            $current = $this->linkedList->getHead();

            if ($current->getNextNode() === null) {
                $this->linkedList->setHead(null);

                return $this;
            }

            while ($current->getNextNode() !== $node) {
                $current = $current->getNextNode();
            }
            $current->setNextNode($node->getNextNode());
        }

        return $this;
    }
}
