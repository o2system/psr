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

// ------------------------------------------------------------------------

use O2System\Spl\Iterators\ArrayIterator;
use Traversable;

/**
 * Class AbstractObjectRegistryPattern
 *
 * The best practice of this pattern class is to contain many objects instance
 * which require to be validated.
 *
 * This pattern class is designed to be able to traversable using foreach.
 *
 * Several cases example:
 * If the data is very varied, use AbstractDataStoragePattern or AbstractItemsStoragePattern class.
 * If all of the data is an object and doesn't required to be validated use AbstractObjectContainerPattern class.
 *
 * Note: This class is an abstract class so it can not be initiated.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractObjectRegistryPattern implements \IteratorAggregate, \Countable
{
    /**
     * AbstractObjectRegistryPattern::$registry
     *
     * The array of contained objects.
     * The access of this property is private so can't be manipulated from the child classes.
     *
     * @var array
     */
    private $registry = [];

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::register
     *
     * Register the object into the class container.
     * An alias of AbstractObjectRegistryPattern::__set method.
     *
     * @param object $object The object to be contained.
     * @param string $offset The object container array offset key.
     *
     * @return void
     */
    public function register( $object, $offset = null )
    {
        $this->__set( $offset, $object );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::getRegistry
     *
     * Retrieve the contained object which specified offset key.
     * An alias of AbstractObjectRegistryPattern::__get method.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function &getObject( $offset )
    {
        return $this->__get( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::__get
     *
     * Application of __get magic method to retrieve the registered object which specified offset key.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    final public function &__get( $offset )
    {
        $get[ $offset ] = null;

        if ( $this->__isset( $offset ) ) {
            return $this->registry[ $offset ];
        }

        return $get[ $offset ];
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::__set
     *
     * Application of __set magic method to registered the object into the container.
     *
     * @param string $offset The object offset key.
     * @param mixed  $object The object to be contained.
     *
     * @return void
     */
    final public function __set( $offset, $object )
    {
        if ( is_object( $object ) AND $this->isValid( $object ) ) {
            if ( is_null( $offset ) ) {
                $offset = get_class( $object );
                $offset = pathinfo( $offset, PATHINFO_FILENAME );
            }

            if ( ! $this->__isset( $offset ) ) {
                $this->registry[ $offset ] = $object;
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::__isset
     *
     * Checks if the object with specified offset key has been set.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    final public function __isset( $offset )
    {
        return (bool)isset( $this->registry[ $offset ] );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::exists
     *
     * Checks if the registry exists an object with specified offset key.
     * An alias of AbstractObjectRegistryPattern::__isset method.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function exists( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::unregister
     *
     * Unregister an objects from the registry.
     * An alias of AbstractObjectRegistryPattern::__unset method.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function unregister( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::__unset
     *
     * Removes an objects from the container.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    final public function __unset( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            unset( $this->registry[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::destroy
     *
     * Removes all objects from the registry and perform each object destruction.
     *
     * @return array Array of old registry
     */
    final public function destroy()
    {
       foreach ( $this->registry as $offset => $object ) {
            if ( method_exists( $object, '__destruct' ) ) {
                $object->__destruct();
            }
            unset( $this->registry[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::getHash
     *
     * Gets a unique identifier for the registered objects.
     *
     * @param $offset
     *
     * @return bool|string Returns FALSE on failure, or unique string identifier of the registered object on success.
     */
    final public function getHash( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            return spl_object_hash( $this->registry[ $offset ] );
        }

        return false;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::count
     *
     * Application of Countable::count method to count the numbers of registered objects.
     *
     * @see http://php.net/manual/en/countable.count.php
     *
     * @return int The numbers of registered objects.
     */
    final public function count()
    {
        return (int)count( $this->registry );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::getIterator
     *
     * Application of IteratorAggregate::getIterator method to retrieve an external iterator.
     *
     * @see  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return ArrayIterator
     */
    final public function getIterator()
    {
        return new ArrayIterator( $this->registry );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectRegistryPattern::isValid
     *
     * Checks if the object is a valid instance.
     *
     * @param object $object The object to be validated.
     *
     * @return bool Returns TRUE on valid or FALSE on failure.
     */
    abstract protected function isValid( $object );
}