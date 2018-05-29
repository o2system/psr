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

namespace O2System\Psr\Log;

// ------------------------------------------------------------------------

/**
 * Interface LoggerAwareInterface
 *
 * Describes a logger-aware instance
 *
 * @see     http://www.php-fig.org/psr/psr-3/#4-psr-log-loggerawareinterface
 *
 * @package O2System\Psr\Log
 */
interface LoggerAwareInterface
{
    /**
     * LoggerAwareInterface::setLogger
     *
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(LoggerInterface $logger);
}
