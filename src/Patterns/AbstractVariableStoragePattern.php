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

/**
 * Class AbstractItemStoragePattern
 *
 * The best practice of this pattern class is to contain many types of item into the storage.
 *
 * This pattern class is designed to be able to traversable using foreach.
 *
 * Note: This class is an abstract class so it can not be initiated.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractVariableStoragePattern implements \ArrayAccess, \Countable
{
    /**
     * AbstractItemStoragePattern::$storage
     *
     * The array of item storage.
     *
     * @var array
     */
    protected $storage = [ ];

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::merge
     *
     * Merge new array of item into the item storage.
     *
     * @param array $item New array of item.
     *
     * @return array The old array of item storage.
     */
    public function merge ( array $item )
    {
        $oldItem = $this->storage;
        $this->storage = array_merge( $this->storage, $item );

        return $oldItem;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::exchange
     *
     * Exchange the array of item storage into the new array of item.
     *
     * @param array $item New array of item.
     *
     * @return array The old array of item storage.
     */
    public function exchange ( array $item )
    {
        $oldItem = $this->storage;
        $this->storage = $item;

        return $oldItem;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::search
     *
     * Search item based on array offset key.
     *
     * @param string $offset The item offset key.
     * @param mixed  $return The fail over of item returns when the item is not found.
     *
     * @return mixed The returns is varies depends on the content of the item or the return variable.
     */
    public function search ( $offset, $return = false )
    {
        if ( array_key_exists( $offset, $this->storage ) ) {
            return $this->storage[ $offset ];
        } elseif ( false !== ( $offsetKey = array_search( $offset, $this->storage ) ) ) {
            return $this->storage[ $offsetKey ];
        }

        return $return;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::exists
     *
     * Checks if the item exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function exists ( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetExists
     *
     * Application of ArrayAccess::offsetExists magic method to checks if the item exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function offsetExists ( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::contains
     *
     * Application of __isset magic method to checks if the item exists on the storage.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function __isset ( $offset )
    {
        return (bool) isset( $this->storage[ $offset ] );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetGet
     *
     * Application of ArrayAccess::offsetGet to retrieve the stored item from the storage.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the item contents, return NULL when there offset is not found.
     */
    public function &offsetGet ( $offset )
    {
        return $this->__get( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::getVariable
     *
     * Retrieve the contained object which specified offset key.
     * An alias of AbstractItemStoragePattern::__get method.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the item contents, return NULL when there offset is not found.
     */
    public function &getVariable ( $offset )
    {
        return $this->__get( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::__get
     *
     * Application of __get magic method to retrieve the contained object which specified offset key.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the item contents, return NULL when there offset is not found.
     */
    public function &__get ( $offset )
    {
        $get[ $offset ] = null;

        if ( $this->__isset( $offset ) ) {
            return $this->storage[ $offset ];
        }

        return $get[ $offset ];
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::store
     *
     * Store the item into the storage.
     * An alias of AbstractItemStoragePattern::__set method.
     *
     * @param string $offset  The item offset key.
     * @param mixed  $value   The item to be stored.
     * @param bool   $replace Replace the existing item or not.
     *
     * @return void
     */
    public function store ( $offset, $value, $replace = false )
    {
        if ( $replace ) {
            $this->__unset( $offset );
        }

        $this->__set( $offset, $value );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetSet
     *
     * Application of ArrayAccess::offsetSet method to store the item into the storage.
     * An alias of AbstractItemStoragePattern::__set method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string $offset The item offset key.
     * @param mixed  $value  The item to be stored.
     *
     * @return void
     */
    public function offsetSet ( $offset, $value )
    {
        $this->__set( $offset, $value );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::__set
     *
     * Application of __set magic method to store the item into the storage.
     *
     * @param string $offset The item offset key.
     * @param mixed  $value  The item to be stored.
     *
     * @return void
     */
    final public function __set ( $offset, $value )
    {
        if ( ! $this->__isset( $offset ) ) {
            $this->storage[ $offset ] = $value;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::remove
     *
     * Removes a item from the storage.
     * An alias of AbstractItemStoragePattern::__unset method.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function remove ( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetUnset
     *
     * Application of ArrayAccess::offsetUnset method to removes a item from the storage.
     * An alias of AbstractItemStoragePattern::__unset method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function offsetUnset ( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::__unset
     *
     * Application of magic method __unset to removes a item from the storage.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    final public function __unset ( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            unset( $this->storage[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::count
     *
     * Application of Countable::count method to count the numbers of contained objects.
     *
     * @see  http://php.net/manual/en/countable.count.php
     * @return int The numbers of item on the storage.
     */
    public function count ()
    {
        return (int) count( $this->storage );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::getArrayCopy
     *
     * Gets a copy of the item storage.
     *
     * @return array Returns a copy of the item storage.
     */
    public function getArrayCopy ()
    {
        return $this->storage;
    }
}