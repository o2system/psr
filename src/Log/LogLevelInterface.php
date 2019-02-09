<?php
/**
 * This file is part of the O2System Framework package.
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
 * Interface LogLevelInterface
 *
 * Describes log levels
 *
 * @package O2System\Psr\Log
 */
interface LogLevelInterface
{
    /**
     * LogLevelInterface::EMERGENCY
     *
     * @var string
     */
    const EMERGENCY = 'emergency';

    /**
     * LogLevelInterface::ALERT
     *
     * @var string
     */
    const ALERT = 'alert';

    /**
     * LogLevelInterface::CRITICAL
     *
     * @var string
     */
    const CRITICAL = 'critical';

    /**
     * LogLevelInterface::ERROR
     *
     * @var string
     */
    const ERROR = 'error';

    /**
     * LogLevelInterface::WARNING
     *
     * @var string
     */
    const WARNING = 'warning';

    /**
     * LogLevelInterface::NOTICE
     *
     * @var string
     */
    const NOTICE = 'notice';

    /**
     * LogLevelInterface::INFO
     *
     * @var string
     */
    const INFO = 'info';

    /**
     * LogLevelInterface::DEBUG
     *
     * @var string
     */
    const DEBUG = 'debug';
}