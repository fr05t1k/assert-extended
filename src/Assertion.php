<?php

namespace Fr05t1k\Assert;

use Assert\Assertion as BaseAssertion;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class Assert
 */
class Assertion extends BaseAssertion
{
    /**
     * Assert value by expression
     *
     * @param string               $expr   Expression
     * @param mixed                $value  Expected value
     * @param mixed                $object Target object
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function valueByExpression($expr, $value, $object, $message = null, $propertyPath = null)
    {
        $language = new ExpressionLanguage();
        $value2 = $language->evaluate($expr, $object);
        if ($value !== $value2) {
            $message = sprintf(
                static::generateMessage($message) ?? 'Value "%s" is not the same as expected value "%s".',
                static::stringify($value),
                static::stringify($value2)
            );

            throw static::createException(
                $value,
                $message,
                static::INVALID_SAME,
                $propertyPath,
                array('expected' => $value2)
            );
        }

        return true;
    }
}
