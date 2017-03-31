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

use O2System\Psr\Http\Message\RequestInterface;

/**
 * Interface MiddlewareInterface
 *
 * @package O2System\Psr\Http
 */
interface MiddlewareServiceInterface
{
    /**
     * MiddlewareServiceInterface::validate
     *
     * Validate the request.
     *
     * @param \O2System\Psr\Http\Message\RequestInterface $request
     *
     * @return mixed
     */
    public function validate( RequestInterface $request );

    /**
     * MiddlewareService::handle
     *
     * Handle the valid request.
     *
     * @param \O2System\Psr\Http\Message\RequestInterface $request
     *
     * @return mixed
     */
    public function handle( RequestInterface $request );

    /**
     * MiddlewareService::terminate
     *
     * @param \O2System\Psr\Http\Message\RequestInterface $request
     *
     * @return mixed
     */
    public function terminate( RequestInterface $request );
}