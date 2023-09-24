<?php

namespace App\Service;

use App\Entity\Node;

class NodeFactory
{
    public static function createWithIntegerValue(int $value): Node
    {
        return (new Node())->setIntValue($value);
    }

    public static function createWithStringValue(string $value): Node
    {
        return (new Node())->setStringValue($value);
    }
}
