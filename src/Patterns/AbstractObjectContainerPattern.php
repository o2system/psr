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

use Traversable;

/**
 * Class AbstractObjectContainerPattern
 *
 * The best practice of this pattern class is to contain many objects instance
 * which doesn't require to be validated.
 *
 * This pattern class is designed to be able to traversable using foreach.
 *
 * Several cases example:
 * If the data is very varied, use AbstractDataStoragePattern or AbstractItemsStoragePattern class.
 * If all of the data is an object and required to be validated use AbstractObjectRegistryPattern class.
 *
 * Note:
 * This class is an abstract class so it can not be initiated.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractObjectContainerPattern implements \IteratorAggregate, \Countable
{
    /**
     * AbstractObjectContainerPattern::$container
     *
     * The array of contained objects.
     * The access of this property is private so can't be manipulated from the child classes.
     *
     * @access private
     * @var array
     */
    private $container = [ ];

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::attach
     *
     * Attach the object into the class container.
     * An alias of AbstractObjectContainerPattern::__set method.
     *
     * @param object $object The object to be contained.
     * @param string $offset The object container array offset key.
     *
     * @return void
     */
    public function attach ( $object, $offset = null )
    {
        $this->__set( $offset, $object );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::__set
     *
     * Application of __set magic method to contained the object into the container.
     *
     * @param string $offset The object offset key.
     * @param mixed  $object The object to be contained.
     *
     * @return void
     */
    final public function __set ( $offset, $object )
    {
        if ( is_object( $object ) ) {
            if ( is_null( $offset ) ) {
                $offset = get_class( $object );
                $offset = pathinfo( $offset, PATHINFO_FILENAME );
            }

            if ( ! $this->__isset( $offset ) ) {
                $this->container[ $offset ] = $object;
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::getObject
     *
     * Retrieve the contained object which specified offset key.
     * An alias of AbstractObjectContainerPattern::__get method.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function &getObject ( $offset )
    {
        return $this->__get( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::__get
     *
     * Application of __get magic method to retrieve the contained object which specified offset key.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    final public function &__get ( $offset )
    {
        $get[ $offset ] = null;

        if ( $this->__isset( $offset ) ) {
            return $this->container[ $offset ];
        }

        return $get[ $offset ];
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::contains
     *
     * Checks if the container contains an object with specified offset key.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function contains ( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::__isset
     *
     * Application of __isset magic method to checks if the object with specified offset key has been set.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    final public function __isset ( $offset )
    {
        return (bool) isset( $this->container[ $offset ] );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::detach
     *
     * Detach an objects from the container.
     * An alias of AbstractObjectContainerPattern::__unset method.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function detach ( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::__unset
     *
     * Application of __unset magic method to removes an objects from the container.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function __unset ( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            unset( $this->container[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::destroy
     *
     * Removes all object from the container and perform each object destruction.
     *
     * @return void
     */
    final public function destroy ()
    {
        foreach ( $this->container as $offset => $object ) {
            if ( method_exists( $object, '__destruct' ) ) {
                $object->__destruct();
            }
            unset( $this->container[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::getHash
     *
     * Gets a unique identifier for the contained objects.
     *
     * @param $offset
     *
     * @return bool|string Returns FALSE on failure, or unique string identifier of the contained object on success.
     */
    final public function getHash ( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            return spl_object_hash( $this->container[ $offset ] );
        }

        return false;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractObjectContainerPattern::count
     *
     * Application of Countable::count method to count the numbers of contained objects.
     *
     * @see http://php.net/manual/en/countable.count.php
     *
     * @return int The numbers of contained objects.
     */
    final public function count ()
    {
        return (int) count( $this->container );
    }

    // ------------------------------------------------------------------------
    
    /**
     * AbstractObjectContainerPattern::getIterator
     *
     * Application of IteratorAggregate::getIterator method to retrieve an external iterator.
     *
     * @see  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     *        <b>Traversable</b>
     */
    final public function getIterator ()
    {
        return new \ArrayIterator( $this->container );
    }
}