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
 * The best practice of this pattern class is to contain many types of data into the storage.
 *
 * This pattern class is designed to be able to traversable using foreach.
 *
 * Several cases example:
 * If all of the data is an object and doesn't required to be validated use AbstractObjectContainerPattern class.
 * If all of the data is an object and required to be validated use AbstractObjectRegistryPattern class.
 *
 * Note: This class is an abstract class so it can not be initiated.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractItemStoragePattern implements
    \ArrayAccess,
    \Countable,
    \Serializable,
    \JsonSerializable
{
    /**
     * AbstractItemStoragePattern::$storage
     *
     * The array of data storage.
     *
     * @var array
     */
    protected $storage = [];

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::merge
     *
     * Merge new array of data into the data storage.
     *
     * @param array $data New array of data.
     *
     * @return array The old array of data storage.
     */
    public function merge( array $data )
    {
        $oldData = $this->storage;
        $this->storage = array_merge( $this->storage, $data );

        return $oldData;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::exchange
     *
     * Exchange the array of data storage into the new array of data.
     *
     * @param array $data New array of data.
     *
     * @return array The old array of data storage.
     */
    public function exchange( array $data )
    {
        $oldData = $this->storage;
        $this->storage = $data;

        return $oldData;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::search
     *
     * Search data based on array offset key.
     *
     * @param string $offset The data offset key.
     * @param mixed  $return The fail over of data returns when the data is not found.
     *
     * @return mixed The returns is varies depends on the content of the data or the return variable.
     */
    public function search( $offset, $return = false )
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
     * Checks if the data exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
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
     * AbstractItemStoragePattern::contains
     *
     * Application of __isset magic method to checks if the data exists on the storage.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function __isset( $offset )
    {
        return (bool)isset( $this->storage[ $offset ] );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetExists
     *
     * Application of ArrayAccess::offsetExists magic method to checks if the data exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function offsetExists( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetGet
     *
     * Application of ArrayAccess::offsetGet to retrieve the stored data from the storage.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function offsetGet( $offset )
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
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function __get( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            return $this->storage[ $offset ];
        }

        return null;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::__set
     *
     * Application of __set magic method to store the data into the storage.
     *
     * @param string $offset The data offset key.
     * @param mixed  $value  The data to be stored.
     *
     * @return void
     */
    public function __set( $offset, $value )
    {
        $this->storage[ $offset ] = $value;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::getItem
     *
     * Retrieve the contained object which specified offset key.
     * An alias of AbstractItemStoragePattern::__get method.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function &getItem( $offset )
    {
        return $this->__get( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::store
     *
     * Store the data into the storage.
     * An alias of AbstractItemStoragePattern::__set method.
     *
     * @param string $offset The data offset key.
     * @param mixed  $value  The data to be stored.
     *
     * @return void
     */
    public function store( $offset, $value )
    {
        $this->__set( $offset, $value );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetSet
     *
     * Application of ArrayAccess::offsetSet method to store the data into the storage.
     * An alias of AbstractItemStoragePattern::__set method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string $offset The data offset key.
     * @param mixed  $value  The data to be stored.
     *
     * @return void
     */
    public function offsetSet( $offset, $value )
    {
        $this->__set( $offset, $value );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::remove
     *
     * Removes a data from the storage.
     * An alias of AbstractItemStoragePattern::__unset method.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function remove( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::__unset
     *
     * Application of magic method __unset to removes a data from the storage.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function __unset( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            unset( $this->storage[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::offsetUnset
     *
     * Application of ArrayAccess::offsetUnset method to removes a data from the storage.
     * An alias of AbstractItemStoragePattern::__unset method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function offsetUnset( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::destroy
     *
     * Removes all object from the container and perform each object destruction.
     *
     * @return array Array of old storage items.
     */
    public function destroy()
    {
        $storage = $this->storage;

        $this->storage = [];

        return $storage;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::count
     *
     * Application of Countable::count method to count the numbers of contained objects.
     *
     * @see  http://php.net/manual/en/countable.count.php
     * @return int The numbers of data on the storage.
     */
    public function count()
    {
        return (int)count( $this->storage );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStorage::serialize
     *
     * Application of Serializable::serialize method to serialize the data storage.
     *
     * @see  http://php.net/manual/en/serializable.serialize.php
     *
     * @return string The string representation of the serialized data storage.
     */
    public function serialize()
    {
        return serialize( $this->storage );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStorage::unserialize
     *
     * Application of Serializable::unserialize method to unserialize and construct the data storage.
     *
     * @see  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized The string representation of the serialized data storage.
     *
     * @return void
     */
    public function unserialize( $serialized )
    {
        $this->storage = unserialize( $serialized );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::jsonSerialize
     *
     * Application of JsonSerializable::jsonSerialize method to encode the data storage.
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return string The string representation of the encoded data storage.
     */
    public function jsonSerialize()
    {
        $options = func_get_args();
        array_unshift( $options, $this->storage );

        return call_user_func_array( 'json_encode', $options );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractItemStoragePattern::getArrayCopy
     *
     * Gets a copy of the data storage.
     *
     * @return array Returns a copy of the data storage.
     */
    public function getArrayCopy()
    {
        return $this->storage;
    }
}