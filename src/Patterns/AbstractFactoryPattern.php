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

namespace O2System\Psr\Patterns;


abstract class AbstractFactoryPattern
{
    private $prototype;

    final public function __construct( AbstractPrototypePattern $prototype )
    {
        $this->prototype =& $prototype;
    }

    abstract public function create( $className, array $classArguments = [] );
}