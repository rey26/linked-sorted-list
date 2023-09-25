<?php

namespace App\Tests\Unit;

use App\Entity\LinkedList;
use App\Entity\Node;
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    public function testDefaultState(): void
    {
        $linkedList = new LinkedList();

        $this->assertNull($linkedList->getHead());
    }

    public function testHeadAssigned(): void
    {
        $linkedList = new LinkedList();
        $headNode = new Node();

        $linkedList->setHead($headNode);

        $this->assertInstanceOf(Node::class, $linkedList->getHead());

        $linkedList->setHead(null);

        $this->assertNull($linkedList->getHead());
    }
}
