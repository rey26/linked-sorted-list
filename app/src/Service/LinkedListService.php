<?php

namespace App\Service;

use App\Entity\LinkedList;
use App\Entity\Node;
use App\Exception\InvalidNodeException;

class LinkedListService
{
    protected ?LinkedList $linkedList = null;

    public function setLinkedList(?LinkedList $linkedList = new LinkedList()): self
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

        if ($head && $head->hasIntegerValue() !== $node->hasIntegerValue()) {
            throw new InvalidNodeException('All nodes in a list should hold either integer or string values');
        }

        if ($head === null || $head->getValue() >= $node->getValue()) {
            $node->setNextNode($head);
            $this->linkedList->setHead($node);
        } else {
            $current = $head;

            if ($head->hasIntegerValue()) {
                while ($current->getNextNode() !== null && $current->getNextNode()->getValue() < $node->getValue()) {
                    $current = $current->getNextNode();
                }
            } else {
                /**
                 * use spaceship operator to compare string values to be in alphabetic order
                 * https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.spaceship-op
                */
                while (
                    $current->getNextNode() !== null &&
                    ($current->getNextNode()->getValue() <=> $node->getValue()) === -1
                ) {
                    $current = $current->getNextNode();
                }
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

    public function findNodeByValue(string|int $value): ?Node
    {
        if ($this->getFirstNode() === null) {
            return null;
        }
        $current = $this->getFirstNode();
        $foundNode = null;

        while ($current->getNextNode() !== null) {
            if ($current->getValue() === $value) {
                $foundNode = $current;

                break;
            }
            $current = $current->getNextNode();
        }

        if ($foundNode === null && $current->getValue() === $value) {
            $foundNode = $current;
        }

        return $foundNode;
    }
}
