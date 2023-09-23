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
}
