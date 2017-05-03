<?php

namespace Fr05t1k\Assert\Tests;

use Fr05t1k\Assert\Assertion;
use PHPUnit\Framework\TestCase;

/**
 * Class AssertionTest
 */
class AssertionTest extends TestCase
{
    /**
     * Data provider for testValueByExpression
     *
     * @see testValueByExpression
     * @return array
     */
    public function valueByExpressionProvider()
    {
        return [
            [
                ['author' => ['username' => 'John']],
                'author["username"]',
                'John',
            ],
            [
                ['ratings' => [1, 2, 3, 5]],
                'ratings[0] + ratings[3]',
                6,
            ],
            [
                ['ratings' => [3, 2, 3, 5]],
                'ratings[0] === ratings[2]',
                true,
            ],
        ];
    }

    /**
     * Test valueByExpression
     *
     * @dataProvider valueByExpressionProvider
     *
     * @param mixed  $object
     * @param string $expr
     * @param mixed  $expectedValue
     */
    public function testValueByExpression($object, $expr, $expectedValue)
    {
        $this->assertTrue(Assertion::valueByExpression($expr, $expectedValue, $object));
    }
}
