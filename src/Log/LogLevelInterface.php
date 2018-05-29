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
 * Interface LogLevelInterface
 *
 * Describes log levels
 *
 * @package O2System\Psr\Log
 */
interface LogLevelInterface
{
    const EMERGENCY = 'emergency';

    const ALERT = 'alert';

    const CRITICAL = 'critical';

    const ERROR = 'error';

    const WARNING = 'warning';

    const NOTICE = 'notice';

    const INFO = 'info';

    const DEBUG = 'debug';
}