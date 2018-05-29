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

namespace O2System\Psr\Cache;

// ------------------------------------------------------------------------

/**
 * Interface CacheItemPoolAdapterInterface
 *
 * @package O2System\Psr\Cache
 */
interface CacheItemPoolAdapterInterface
{
    /**
     * CacheItemPoolAdapterInterface::connect
     *
     * @param array $config Cache adapter connection configuration.
     *
     * @return void
     */
    public function connect(array $config);

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::getPlatform
     *
     * Gets item pool adapter platform name.
     *
     * @return string
     */
    public function getPlatform();

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::increment
     *
     * Increment a raw value offset.
     *
     * @param string $key  Cache item key.
     * @param int    $step Increment step to add.
     *
     * @return mixed New value on success or FALSE on failure.
     */
    public function increment($key, $step = 1);

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::decrement
     *
     * Decrement a raw value offset.
     *
     * @param string $key  Cache item key.
     * @param int    $step Decrement step to add.
     *
     * @return mixed New value on success or FALSE on failure.
     */
    public function decrement($key, $step = 1);

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::getInfo
     *
     * Gets item pool adapter info.
     *
     * @return mixed
     */
    public function getInfo();

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::getInfo
     *
     * Gets item pool adapter stats.
     *
     * @return mixed
     */
    public function getStats();

    // ------------------------------------------------------------------------

    /**
     * CacheItemPoolAdapterInterface::isSupported
     *
     * Checks if this adapter is supported on this system.
     *
     * @return bool Returns FALSE if not supported.
     */
    public function isSupported();
}