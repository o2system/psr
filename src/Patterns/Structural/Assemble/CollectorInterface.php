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

namespace O2System\Psr\Patterns\Structural\Assemble;

/**
 * Interface CollectorInterface
 * @package O2System\Psr\Patterns\Assemble
 */
interface CollectorInterface
{
    /**
     * CollectorInterface::collect
     *
     * Collection process.
     *
     * @return void
     */
    public function collect();
}