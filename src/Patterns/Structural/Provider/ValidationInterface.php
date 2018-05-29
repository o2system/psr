<?php
/**
 * This file is part of the O2System PHP Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Steeve Andrian Salim
 * @copyright      Copyright (c) Steeve Andrian Salim
 */

// ------------------------------------------------------------------------

namespace O2System\Psr\Patterns\Structural\Provider;

/**
 * Interface ValidationInterface
 * @package O2System\Psr\Patterns\Structural\Provider
 */
interface ValidationInterface
{
    /**
     * ValidationInterface::validate
     *
     * Checks if the object is a valid instance.
     *
     * @param object $object The object to be validated.
     *
     * @return bool Returns TRUE on valid or FALSE on failure.
     */
    public function validate($object);
}