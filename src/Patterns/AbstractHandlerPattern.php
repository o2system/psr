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

/**
 * Class AbstractHandlerPattern
 *
 * This pattern class is used when you're going to create a class which has a handler object instance.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractHandlerPattern
{
    /**
     * AbstractHandlerPattern::$handler
     *
     * Handler object instance.
     *
     * @var object
     */
    protected $handler;

    // ------------------------------------------------------------------------

    /**
     * AbstractHandler::loadHandler
     *
     * Load the handler based on handler class name.
     *
     * @param string $handler The handler class name.
     *
     * @return object The handler object instance.
     */
    abstract public function loadHandler( $handler );

    // ------------------------------------------------------------------------

    /**
     * AbstractHandler::getHandler
     *
     * Gets the handler object instance.
     *
     * @return object|bool Returns the handler object instance or FALSE if the handler is not valid.
     */
    public function getHandler()
    {
        if ( $this->isValidHandler( $this->handler ) ) {
            return $this->handler;
        }

        return false;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractHandler::setHandler
     *
     * Sets the handler object instance.
     *
     * @param object $handler The handler object instance.
     *
     * @return void
     */
    public function setHandler( &$handler )
    {
        if ( $this->isValidHandler( $handler ) ) {
            $this->handler = $handler;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractHandler::isValidHandler
     *
     * Checks if the object is a valid instance.
     *
     * @param object $handler The handler object instance to be validated.
     *
     * return bool Returns TRUE on valid and FALSE on invalid.
     */
    abstract public function isValidHandler( $handler );
}