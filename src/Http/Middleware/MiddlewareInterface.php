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

namespace O2System\Psr\Http\Middleware;

// ------------------------------------------------------------------------

/**
 * Interface MiddlewareInterface
 *
 * @package O2System\Psr\Http
 */
interface MiddlewareInterface
{
    /**
     * MiddlewareInterface::run
     *
     * Run the middleware service queue.
     *
     * @return void
     */
    public function run();
}