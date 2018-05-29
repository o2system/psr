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

namespace O2System\Psr\Parser;

/**
 * Interface ParserDriverInterface
 *
 * @package O2System\Psr\Parser
 */
interface ParserDriverInterface
{
    public function setEngine($engine);

    public function &getEngine();

    public function loadFile($filePath);

    public function loadString($string);

    public function parse(array $vars = []);

    public function isSupported();
}