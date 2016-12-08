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

namespace O2System\Psr\Http;

// ------------------------------------------------------------------------

use O2System\Psr\Http\Message\RequestInterface;

/**
 * Interface ClientInterface
 *
 * @package O2System\Psr\Http
 */
interface ClientInterface
{
    public function options ( RequestInterface $request );

    public function get ( $request, array $params = [ ], array $headers = [ ] );

    public function head ( RequestInterface $request );

    public function patch ( RequestInterface $request );

    public function post ( RequestInterface $request );

    public function put ( RequestInterface $request );

    public function delete ( RequestInterface $request );

    public function trace ( RequestInterface $request );

    public function connect ( RequestInterface $request );

    public function getTransport ();

    public function withTransport ( TransportInterface $transport );
}