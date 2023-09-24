<?php

namespace App\Tests\Unit;

use App\Entity\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testCreateIntegerNode(): void
    {
        $node = new Node();
        $node->setIntValue(2);

        $this->assertInstanceOf(Node::class, $node);
        $this->assertSame(2, $node->getValue());
        $this->assertNull($node->getNextNode());
    }

    public function testCreateStringNode(): void
    {
        $node = new Node();
        $node->setStringValue('string');

        $this->assertInstanceOf(Node::class, $node);
        $this->assertSame('string', $node->getValue());
        $this->assertNull($node->getNextNode());
    }

    public function testNodeNextValue(): void
    {
        $node = new Node();
        $nextNode = new Node();
        $node->setNextNode($nextNode);

        $this->assertInstanceOf(Node::class, $node->getNextNode());
        $this->assertNull($nextNode->getNextNode());
    }
}
