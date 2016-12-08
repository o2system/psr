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


abstract class AbstractChildPattern
{
    /**
     * Parent Class
     *
     * @var ParentPatternClass
     */
    protected $parentObject;

    public function setParentObject ( AbstractParentPattern $parentObject )
    {
        $this->parentObject =& $parentObject;
    }
}